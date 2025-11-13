<?php
/**
 * API Name : Candidate Registration (Third Step)
 * Version  : 1.0
 * Method   : POST
 * Table    : registration_header_all

 * Logic Part
 1. Third step step of registration get data and post data and and make profile varified
 
 * Tested 23-10-2025
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Token, Authorization");
date_default_timezone_set('Asia/Kolkata');
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
$db   = DB::getInstance();
$conn = $db->getConnection();
$headers = getallheaders();
$token   = isset($headers['Authorization']) ? $headers['Authorization'] : null;
$method  = $_SERVER['REQUEST_METHOD'];
$now     = date("Y-m-d H:i:s");
if ($method === 'POST') {
    $reg_id = isset($_POST['reg_id']) ? trim($_POST['reg_id']) : '';
    $reg_id = isset($_POST['reg_id']) ? trim($_POST['reg_id']) : '';
    if (empty($reg_id)) {
        echo json_encode([
            "error_code" => 101
        ]);
        exit;
    }
    check_token($reg_id, $token, $conn);
    $query_user = "SELECT reg_full_name, reg_mobile, reg_email, reg_dob, dist_id, reg_institution_type, reg_cat_for FROM registration_header_all WHERE reg_id = $reg_id";
    $result_user = $conn->query($query_user);
    if (!$result_user) {
        echo json_encode([
            "error_code" => 201
        ]);
        exit;
    }
    if ($result_user->num_rows === 0) {
        echo json_encode([
            "error_code" => 202
        ]);
        exit;
    }
    $user           = $result_user->fetch_assoc();
    $dob            = isset($user['reg_dob']) ? $user['reg_dob'] : null;
    $dist_id        = isset($user['dist_id']) ? $user['dist_id'] : null;
    $reg_email      = isset($user['reg_email']) ? $user['reg_email'] : null;
    $reg_mobile     = isset($user['reg_mobile']) ? $user['reg_mobile'] : null;
    $reg_full_name  = isset($user['reg_full_name']) ? $user['reg_full_name'] : 'USER';
    $inst_type      = isset($user['reg_institution_type']) ? $user['reg_institution_type'] : null;
    $reg_cat_for    = isset($user['reg_cat_for']) ? $user['reg_cat_for'] : null;
    $age            = 0;
    if (!empty($dob)) {
        $age = (new DateTime($dob))->diff(new DateTime('today'))->y;
    }
    $dist_name = null;
    if (!empty($dist_id)) {
        $result_dist = $conn->query("SELECT dist_name FROM district_header_all WHERE dist_id = $dist_id");
        if ($result_dist && $result_dist->num_rows > 0) {
            $dist_row = $result_dist->fetch_assoc();
            $dist_name = isset($dist_row['dist_name']) ? $dist_row['dist_name'] : null;
        }
    }
    $admit_card_url = null;
    if (isset($_FILES['admit_card']) && $_FILES['admit_card']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
        if (!in_array($_FILES['admit_card']['type'], $allowedTypes)) {
            echo json_encode([
                "error_code" => 102,
                "status"     => "error",
                "message"    => "Only JPG, PNG or PDF files allowed"
            ]);
            exit;
        }
        if ($_FILES['admit_card']['size'] > 2 * 1024 * 1024) {
            echo json_encode([
                "error_code" => 103,
                "status"     => "error",
                "message"    => "File size must be less than 2MB"
            ]);
            exit;
        }
        $fileTmp   = $_FILES['admit_card']['tmp_name'];
        $fileName  = time() . "_" . basename($_FILES['admit_card']['name']);
        $ftpConfig = [
            'host'     => 'ftp.staffhandler.com',
            'user'     => 'admitcard@yuvasanskaar.staffhandler.com',
            'password' => '1nMmDMH?&E(JA]om',
            'baseUrl'  => 'https://yuvasanskaar.staffhandler.com/admit_card/students/',
        ];
        $ftpConn = ftp_connect($ftpConfig['host']);
        if (!$ftpConn) {
            echo json_encode(["error_code" => 105]);
            exit;
        }
        $login = ftp_login($ftpConn, $ftpConfig['user'], $ftpConfig['password']);
        if (!$login) {
            ftp_close($ftpConn);
            echo json_encode(["error_code" => 106]);
            exit;
        }
        ftp_pasv($ftpConn, true);
        $fileTmp  = $_FILES['admit_card']['tmp_name'];
        $fileName = time() . "_" . basename($_FILES['admit_card']['name']);
        $remoteDir = '';
        if (!@ftp_chdir($ftpConn, $remoteDir)) {
            echo json_encode([
                "error_code" => 107,
                "status"     => "error",
                "message"    => "Cannot change to FTP directory — verify path: $remoteDir"
            ]);
            ftp_close($ftpConn);
            exit;
        }
        if ($_FILES['admit_card']['type'] != "application/pdf") {
            if (function_exists('compressImage')) {
                compressImage($fileTmp, $fileTmp, 40);
            }
        }
        $remoteFile = rtrim($remoteDir, '/') . '/' . $fileName;
        if (ftp_put($ftpConn, $remoteFile, $fileTmp, FTP_BINARY)) {
            $admit_card_url = 'https://yuvasanskaar.staffhandler.com/admit_card/students/' . $fileName; 
        } 
        ftp_close($ftpConn);
    } 
    $updateQuery = "UPDATE registration_header_all SET reg_verification_status = 1, reg_updated_on = '$now', reg_varified_on = '$now', reg_admit_card = '$admit_card_url' WHERE reg_id = $reg_id";
    $update_result = $conn->query($updateQuery);
    if (!$update_result) {
        echo json_encode([
            "error_code" => 301
        ]);
        exit;
    }
    send_mail($admit_card_url, $reg_email);
    send_sms($reg_mobile, $admit_card_url);
    echo json_encode([
        "error_code" => 200,
        "reg_verification_status" => 1,
        "cat_for"    => $reg_cat_for,
        "dist_name"  => $dist_name,
        "reg_full_name" => $reg_full_name,
    ]);
}
else {
    echo json_encode([
        "error_code" => 405
    ]);
}

function compressImage($source, $destination, $quality = 60) {
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg' || $info['mime'] == 'image/jpg') {
        $image = imagecreatefromjpeg($source);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
        imagejpeg($image, $destination, $quality);
        return true;
    } else {
        return false; 
    }
    imagejpeg($image, $destination, $quality);
    return true;
}
function send_mail($url, $email)  {
    $payload = [
        "recipients" => [
            [
                "to" => [
                    [
                        "email" => $email
                    ]
                ],
                "variables" => [
                    "VAR1" => $url 
                ]
            ]
        ],
        "from" => [
            "email" => "geetamahotsav@mpsthapanautsav.in"
        ],
        "domain" => "mpsthapanautsav.in",
        "template_id" => "geeta_admit_card"
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
function send_sms($mobile, $url) {
    $authKey    = "472285A02FfvvxxWCo68e603a2P1";  
    $templateId = "6909b7e4a57e7718206c48cb";
    $postData = [
        "template_id" => $templateId,
        "short_url"   => 1,          
        "short_url_expiry" => 86400, 
        "realTimeResponse" => 1, 
        "recipients"  => [[
            "mobiles" => "91" . $mobile, 
            "var1"    => $url 
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
    if (in_array($httpCode, [200, 202])) {
        return true;
    } else {
        error_log("SMS failed: HTTP $httpCode - " . $resp);
        return false;
    }
}
// function send_sms($mobile, $url, $scheduleAt = null) {
//     $authKey    = "472285A02FfvvxxWCo68e603a2P1";  
//     $templateId = "6909b7e4a57e7718206c48cb";
//     // if ($scheduleAt) {
//     //     $ts = strtotime($scheduleAt);
//     //     if ($ts === false) {
//     //         error_log("Invalid scheduleAt value: $scheduleAt");
//     //         return false;
//     //     }
//     // } else {
//     //     $ts = time(); 
//     // }
//     // $minFuture = time() + 60;
//     // if ($ts < $minFuture) {
//     //     $ts = $minFuture + 60; 
//     // }
//     // $schtime = date('Y-m-d H:i:s', $ts);
//     $postData = [
//         "template_id" => $templateId,
//         "short_url"   => "1",  
//         "short_url_expiry" => 86400, 
//         "recipients"  => [[
//             "mobiles" => "91" . $mobile,
//             "var1"    => $url
//         ]]
//     ];
    
//     $curl = curl_init();
//     curl_setopt_array($curl, [
//         CURLOPT_URL => "https://control.msg91.com/api/v5/flow/",
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_CUSTOMREQUEST  => "POST",
//         CURLOPT_POSTFIELDS     => json_encode($postData),
//         CURLOPT_HTTPHEADER     => [
//             "accept: application/json",
//             "authkey: $authKey",
//             "content-type: application/json",
//             "X-API-Key: $authKey",
//             "Cookie: HELLO_APP_HASH=b2lpakVGNUJlT1U1QzIyQkVMekZKOURGeVBsclR5bUM0THhGcGNyWndSUT0%3D; PHPSESSID=3dmmjus2tjh4spad2gdsl858ra"
//         ],
//     ]);
//     $response = curl_exec($curl);
//     $err = curl_error($curl);
//     $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//     curl_close($curl);
//     if ($err) {
//         error_log("SMS sending failed: " . $err);
//         return false;
//     }
//     if (in_array($httpCode, [200, 202])) {
//         return true;
//     } else {
//         error_log("SMS failed: HTTP $httpCode - " . $response);
//         return false;
//     }
// }

?>
