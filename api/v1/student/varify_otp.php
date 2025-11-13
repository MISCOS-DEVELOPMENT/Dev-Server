<?php
/**
 * API Name : Verify OTP API
 * Version  : 1.0
 * Table    : sms_receiver_details_all
 * 
 * Logic:
 *  1. Get mobile & otp from request.
 *  2. Check OTP in today's date entry.
 *  3. If OTP matches => return success (200) and delete OTP.
 *  4. If not => return 201 (OTP not match).
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(["status" => "OK - preflight"]);
    exit;
}
require_once '../../../config/db_connection.php';
$db   = DB::getInstance();
$conn = $db->getConnection();
$mobile = isset($_REQUEST['mobile']) ? trim($_REQUEST['mobile']) : '';
$otp    = isset($_REQUEST['otp']) ? trim($_REQUEST['otp']) : '';
if (!$mobile || !$otp) {
    echo json_encode([
        "error_code" => 100,
        "status" => "error",
        "message" => "Mobile number and OTP are required"
    ]);
    exit;
}
$sql = "SELECT srd_id, srd_otp FROM sms_receiver_details_all WHERE srd_mobile_no = '$mobile' AND srd_send_date = '$today' LIMIT 1";
$res = $conn->query($sql);
if ($res === false) {
    echo json_encode([
        "error_code" => 500
    ]);
    exit;
}
if ($res->num_rows == 0) {
    echo json_encode([
        "error_code" => 201
    ]);
    exit;
}
$row = $res->fetch_assoc();
if ((string)$row['srd_otp'] === (string)$otp) {
    $srd_id = (int)$row['srd_id'];
    $delete_sql = "UPDATE sms_receiver_details_all SET srd_otp = NULL WHERE srd_id = $srd_id";
    $conn->query($delete_sql);

    $sql_get_pass = "SELECT reg_pass, reg_email FROM registration_header_all WHERE reg_mobile = '$mobile'";
    $res_get_pass = $conn->query($sql_get_pass);
    $row_get_pass = $res_get_pass->fetch_assoc();
    if (!empty($row_get_pass['reg_pass'])) {
        $password     = $row_get_pass['reg_pass'];
        $email         = $row_get_pass['reg_email'];
        if($email) {
            send_mail($mobile, $password, $email);
        }
        send_sms($mobile, $mobile, $password);
    }
    echo json_encode([
        "error_code" => 200
    ]);
} else {
    echo json_encode([
        "error_code" => 201
    ]);
}

function send_mail($user_name, $password, $email)  {
    $payload = [
        "recipients" => [
            [
                "to" => [
                    [
                        "email" => $email
                    ]
                ],
                "variables" => [
                    "VAR1" => $user_name,     
                    "VAR2" => $password 
                ]
            ]
        ],
        "from" => [
            "email" => "geetamahotsav@mpsthapanautsav.in"
        ],
        "domain" => "mpsthapanautsav.in",
        "template_id" => "geeta_login_credentials"
    ];
    $ch = curl_init('https://control.msg91.com/api/v5/email/send');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Accept: application/json',
            'authkey: 472285A02FfvvxxWCo68e603a2P1',
        ],
        CURLOPT_POSTFIELDS => json_encode($payload),
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if (in_array($httpCode, [200, 202])) {
        return true;
    } else {
        error_log("Pending PO Email failed: HTTP $httpCode - " . $response);
        return false;
    }
}
function send_sms($mobile, $user_id, $pass) {
    $authKey    = "472285A02FfvvxxWCo68e603a2P1";  
    $templateId = "6909b7f5c5b15123aa6c3c83";
    // Prepare payload
    $postData = [
        "template_id" => $templateId,
        "recipients"  => [[
            "mobiles" => "91" . $mobile, 
            "var1"    => $user_id,
            "var2"    => $pass
        ]]
    ];
    // Initialize CURL
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://control.msg91.com/api/v5/flow/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST  => "POST",
        CURLOPT_POSTFIELDS     => json_encode($postData),
        CURLOPT_HTTPHEADER     => [
            "accept: application/json",
            "authkey: $authKey",
            "content-type: application/json"
        ],
    ]);
    // Execute
    $resp = curl_exec($curl);
    $err  = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    // Handle result
    if ($err) {
        error_log("SMS sending failed: " . $err);
        return false;
    }
    if (in_array($httpCode, [200, 202])) {
        return true;
    } else {
        error_log("SMS failed: HTTP $httpCode - " . $resp);
        return false;
    }
}

?>
