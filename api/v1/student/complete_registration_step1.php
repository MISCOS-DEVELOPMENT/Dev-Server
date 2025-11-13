<?php
/**
 * API Name : Complete registration (First Step)
 * Version  : 1.0
 * Method   : GET / POST
 * Table    : registration_header_all

 * Logic Part
 1. first step of registration get data and post data and send to next stpe after post
 
 * Tested 23-10-2025
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Token, Mode, Authorization");
date_default_timezone_set('Asia/Kolkata');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(["status" => "OK - preflight"]);
    exit;
}
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
$db   = DB::getInstance();
$conn = $db->getConnection();
$headers     = getallheaders();
$token       = isset($headers['Authorization']) ? $headers['Authorization'] : null;
$method      = $_SERVER['REQUEST_METHOD'];
$now         = date("Y-m-d H:i:s");
$error_code  = 0;
$status      = "";
$message     = "";
$response    = [];
if ($method === 'GET') {
    $reg_id = isset($_GET['reg_id']) ? $_GET['reg_id'] : '';
    if (empty($reg_id)) {
        $error_code = 101;
        $status     = "error";
        $message    = "reg_id is required";
        echo json_encode(["error_code"=>$error_code]);
        exit;
    }
    check_token($reg_id, $token, $conn);
    $query = "SELECT reg_registration_no, reg_full_name, reg_mobile, reg_email, reg_aadhar_no, reg_gender, reg_dob, dist_id, reg_address, reg_is_disabled, reg_cat_for FROM registration_header_all WHERE reg_id = $reg_id";
    $result = $conn->query($query);
    if (!$result) {
        $error_code = 201;
        $status     = "error";
        $message    = "Server error: ".$conn->error;
        echo json_encode(["error_code"=>$error_code]);
        exit;
    }
    if ($result->num_rows == 0) {
        $error_code = 204;
        $status     = "error";
        $message    = "No record found";
        echo json_encode(["error_code"=>$error_code]);
        exit;
    }
    $userData    = $result->fetch_assoc();
    $distResult  = $conn->query("SELECT dist_id, dist_name, dist_state FROM district_header_all WHERE dist_status = 1");
    $districts   = $distResult->fetch_all(MYSQLI_ASSOC);
    $error_code  = 200;
    $status      = "success";
    $message     = "Data fetched successfully";
    $dist_id     = $userData['dist_id'];
    if(!empty($dist_id)) {
        $sql_dist_name = "SELECT dist_name FROM district_header_all WHERE dist_id = $dist_id";
        $result_dist_name  = mysqli_query($conn, $sql_dist_name);
        if($result_dist_name){
            $row_dist_name  = mysqli_fetch_assoc($result_dist_name);
            $dist_name = $row_dist_name['dist_name'];
            $userData['dist_name'] = $dist_name;
        } 
    } else {
        $dist_name = '';
        $userData['dist_name'] = $dist_name;
    }
    
    echo json_encode([
        "error_code" => $error_code,
        "data"       => $userData,
        "districts"  => $districts
    ]);
    exit;
}
if ($method === 'POST') {
    $reg_id        = isset($_POST['reg_id']) ? $_POST['reg_id'] : '';
    $reg_full_name = isset($_POST['reg_full_name']) ? $_POST['reg_full_name'] : '';
    $reg_mobile    = isset($_POST['reg_mobile']) ? $_POST['reg_mobile'] : '';
    $reg_dob       = isset($_POST['reg_dob']) ? $_POST['reg_dob'] : '';
    $reg_email     = isset($_POST['reg_email']) ? $_POST['reg_email'] : '';
    $reg_aadhar_no = isset($_POST['reg_aadhar_no']) ? $_POST['reg_aadhar_no'] : '';
    $reg_gender    = isset($_POST['reg_gender']) ? $_POST['reg_gender'] : '';
    $reg_address   = isset($_POST['reg_address']) ? $_POST['reg_address'] : '';
    $reg_is_disabled= isset($_POST['reg_is_disabled']) ? $_POST['reg_is_disabled'] : '';
    $reg_dist       = isset($_POST['dist_id']) && $_POST['dist_id'] !== '' ? $_POST['dist_id'] : 'NULL';
    $reg_cat_for    = isset($_POST['reg_cat_for']) && $_POST['reg_cat_for'] !== '' ? $_POST['reg_cat_for'] : 'NULL';
    if (empty($reg_id)) {
        $error_code = 101;
        $status     = "error";
        $message    = "reg_id is required";
        echo json_encode(["error_code"=>$error_code]);
        exit;
    }
    check_token($reg_id, $token, $conn);
    $updateQuery = "UPDATE registration_header_all SET
                        reg_full_name = '$reg_full_name',
                        reg_mobile = '$reg_mobile',
                        reg_email = '$reg_email',
                        reg_dob = '$reg_dob',
                        reg_aadhar_no = '$reg_aadhar_no',
                        reg_gender = '$reg_gender',
                        dist_id = $reg_dist,
                        reg_address = '$reg_address',
                        reg_updated_on = '$now',
                        reg_is_disabled = '$reg_is_disabled',
                        reg_cat_for = '$reg_cat_for'
                    WHERE reg_id = $reg_id";
    $result = $conn->query($updateQuery);
    if (!$result) {
        $error_code = 201;
        $status     = "error";
        $message    = "Server error: ".$conn->error;
        echo json_encode(["error_code"=>$error_code]);
        exit;
    }
    $error_code = $conn->affected_rows > 0 ? 200 : 204;
    $status     = $conn->affected_rows > 0 ? "success" : "error";
    $message    = $conn->affected_rows > 0 ? "Record updated successfully" : "No changes made";
    echo json_encode([
        "error_code" => $error_code
    ]);
    exit;
}
?>

