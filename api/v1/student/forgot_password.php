<?php
/**
 * API Name : Forgot Password - Send OTP
 * Version  : 1.0
 * Table    : registration_header_all
 * 
 * Logic:
 *  1. Check if mobile number is registered.
 *  2. If not registered => return 201.
 *  3. If registered => send OTP via SMS (and email if available).
 *  4. Restrict OTP sending count using sms_receiver_details_all.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('Asia/Kolkata');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
$today = date('Y-m-d');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(["status" => "OK - preflight"]);
    exit;
}
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
$db   = DB::getInstance();
$conn = $db->getConnection();
$mobile = isset($_POST['reg_mobile']) ? trim($_POST['reg_mobile']) : null;
if (!$mobile) {
    echo json_encode([
        "error_code" => 100
    ]);
    exit;
}

// Check if mobile is registered
$checkSql = "SELECT reg_email FROM registration_header_all WHERE reg_mobile = '$mobile' LIMIT 1";
$checkResult = mysqli_query($conn, $checkSql);

if (mysqli_num_rows($checkResult) == 0) {
    echo json_encode([
        "error_code" => 201
    ]);
    exit;
}

$row = mysqli_fetch_assoc($checkResult);
$email = $row['reg_email'] ?? null;
$otp = rand(1000, 9999);
list($otp_attempt, $send_count) = check_otp_count($conn, $mobile, $otp);
$sms_response = send_sms($mobile, $otp);
$mail_response = false;
if ($email) {
    $mail_response = send_mail($otp, $email);
}
$response = [
    "error_code" => 200, 
    "limit" => $otp_attempt,
    "send_count" => $send_count
];

echo json_encode($response);

// ----------------- Helper Functions -----------------
function send_mail($otp, $email) {
    $payload = [
        "recipients" => [
            [
                "to" => [
                    ["email" => $email]
                ],
                "variables" => [
                    "VAR1" => $otp
                ]
            ]
        ],
        "from" => ["email" => "geetamahotsav@mpsthapanautsav.in"],
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

    return in_array($httpCode, [200, 202]);
}
function send_sms($mobile, $otp, $type = "Forgot Password") {
    $authKey    = "472285A02FfvvxxWCo68e603a2P1";
    $templateId = "69117507905c980b9423bfc3";

    $postData = [
        "template_id" => $templateId,
        "recipients"  => [[
            "mobiles" => "91" . $mobile,
            "var1"    => $type, 
            "var2"    => $otp
        ]]
    ];

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

    $resp = curl_exec($curl);
    $err  = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($err) {
        error_log("SMS sending failed: " . $err);
        return false;
    }

    return in_array($httpCode, [200, 202]);
}
?>


