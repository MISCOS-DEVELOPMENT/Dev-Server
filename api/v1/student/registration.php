<?php
/**
 * Date     : 29-09-2025
 * API Name : Complete Registration API
 * Version  : 1.0
 * Method   : POST
 * Table    : registration_header_all
 
* logic part 
    1.get basic details from user and save to database 
    2.check diupication of email and mobile no
    3.generate password 
    4.send username and password on email
    5.sms pending 

* Tested 10-10-2025
 */
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, token, mode, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(["status" => "OK - preflight"]);
    exit;
}
date_default_timezone_set('Asia/Kolkata');
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
$db = DB::getInstance();
$conn = $db->getConnection();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error_code" => "203", "status" => "error"]);
    exit;
}
$entered_otp             = isset($_POST['entered_otp']) ? $_POST['entered_otp'] : "";
$reg_full_name           = isset($_POST['reg_full_name']) ? $_POST['reg_full_name'] : "";
$reg_mobile              = isset($_POST['reg_mobile']) ? $_POST['reg_mobile'] : "";
$reg_email               = isset($_POST['reg_email']) ? $_POST['reg_email'] : "";
$pass                    = rand(1000, 9999);
$now                     = date("Y-m-d H:i:s");
$reg_token_id            = bin2hex(random_bytes(32));
$reg_no                  = generate_unique_id($conn, 'registration_header_all', 999);
$prefix                  = strtoupper(substr($reg_full_name, 0, 3));
$reg_id_trimmed          = substr((string)$reg_no, 3); 
$reg_registration_no     = $prefix . $reg_id_trimmed;
$sql = "INSERT INTO registration_header_all (reg_full_name, reg_mobile, reg_email, reg_inserted_on, reg_registration_no, reg_pass, reg_token_id) VALUES (?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $reg_full_name, $reg_mobile, $reg_email, $now, $reg_registration_no, $pass, $reg_token_id);
if ($stmt->execute()) {
    $reg_id = $conn->insert_id;
    $user = [
        'reg_id' => $reg_id,
        'reg_full_name' => $reg_full_name,
        'reg_mobile' => $reg_mobile,
        'reg_email' => $reg_email,
        'reg_registration_no' => $reg_registration_no,
        'reg_verification_status' => 2,
    ];
    $mail_responce = send_mail($reg_mobile, $pass, $reg_email);
    send_sms($reg_mobile, $reg_mobile, $pass);
    echo json_encode([
        "error_code" => "200",
        "status" => "success",
        "data"       => $user,
        "token"      => $reg_token_id,
        "cat_for"      => 0,
    ]);
} else {
    echo json_encode(["error_code" => "201", "status" => "error"]);
}
$stmt->close();
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