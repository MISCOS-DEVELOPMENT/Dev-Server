<?php
/**
 * API Name : generate otp API
 * Version  : 1.0
 * Table    : registration_header_all


* Logic part
    1. chekc mobile no and email altready register or not and then send opt on register email id

* Tested 14-10-2025

* Logic part
    1. check send otp count in sms_receiver_details_all match it with factory_reset_table otp_count if excide then restrict it to send on that day
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(["status" => "OK - preflight"]);
    exit;
}
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
$db   = DB::getInstance();
$conn = $db->getConnection();
$mobile = isset($_POST['reg_mobile']) ? $_POST['reg_mobile'] : null;
$email = isset($_POST['reg_email']) ? $_POST['reg_email'] : null;
if (!$mobile) {
    echo json_encode([
        "error_code" => 100
    ]);
    exit;
} 
$otp = rand(1000, 9999);
$checkSql = "SELECT reg_mobile FROM registration_header_all WHERE reg_mobile = '$mobile'";
$checkResult = mysqli_query($conn, $checkSql);
if (mysqli_num_rows($checkResult) > 0) {
    $row = mysqli_fetch_assoc($checkResult);
    if ($row['reg_mobile'] == $mobile) {
        echo json_encode(["error_code" => "302", "status" => "error", "message" => "Mobile already registered"]);
         exit;
    }
}
list($otp_attempt, $send_count) = check_otp_count($conn, $mobile, $otp);
if($email) {
    $mail_responce = send_mail($otp, $email);
}
$sms_responce = send_sms($mobile, $otp);
$response =[
            "error_code" => "200",
            "limit" => $otp_attempt,
            "send_count" => $send_count,
        ];
// Return MSG91 response as JSON
echo json_encode($response);
function send_mail($otp, $email)  {
    $response ['email'] =  $email;
    $response ['test'] =  'test';
    $payload = [
        "recipients" => [
            [
                "to" => [
                    [
                        "email" => $email,
                    ]
                ],
                "variables" => [
                    "VAR1" => $otp,               ]
            ]
        ],
        "from" => [
            "email" => "geetamahotsav@mpsthapanautsav.in"
        ],
        "domain" => "mpsthapanautsav.in",
        "template_id" => "geeta_otp"
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
function send_sms($mobile, $otp, $type = "Register") {
    $authKey    = "472285A02FfvvxxWCo68e603a2P1";  
    $templateId = "69117507905c980b9423bfc3";
    // Prepare payload
    $postData = [
        "template_id" => $templateId,
        "recipients"  => [[
            "mobiles" => "91" . $mobile, 
            "var1"    => $type, 
            "var2"    => $otp 
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






