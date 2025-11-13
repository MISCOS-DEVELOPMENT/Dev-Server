<?php
/**
 * API Name : Candidate Registration (Second Step)
 * Version  : 1.0
 * Method   : GET / POST
 * Table    : registration_header_all

* Logic Part
 1. second step of registration get data and post data and send to next stpe after post
 
 * Tested 23-10-2025
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Token, Authorization");
date_default_timezone_set('Asia/Kolkata');
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
   $query = "SELECT reg_parents_name, reg_parents_mobile, reg_institution_type, reg_class, reg_grade, reg_year, reg_selected_category, reg_language, reg_device_capability, reg_other_institute, reg_other_institute_name, coh_id, sch_id, dist_id FROM registration_header_all WHERE reg_id = $reg_id";
    $result = $conn->query($query);
    if (!$result) {
        $error_code = 201;
        $status     = "error";
        $message    = "Server error: " . $conn->error;
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
    $userData = $result->fetch_assoc();
    $college  = [];
    $school   = [];
    if (!empty($userData['dist_id'])) {
        $dist_id = $userData['dist_id'];
        $collegeResult = $conn->query("SELECT coh_id, coh_name, dist_id FROM college_header_all WHERE coh_status = 1 AND dist_id = $dist_id");
        if ($collegeResult) {
            $college = $collegeResult->fetch_all(MYSQLI_ASSOC);
        }
        $schoolResult = $conn->query("SELECT sch_id, sch_name, dist_id FROM school_header_all WHERE sch_status = 1 AND dist_id = $dist_id");
        if ($schoolResult) {
            $school = $schoolResult->fetch_all(MYSQLI_ASSOC);
        }
    }
    $error_code = 200;
    $status     = "success";
    $message    = "Data fetched successfully";
    echo json_encode([
        "error_code" => $error_code,
        "data"       => $userData,
        "college"    => $college,
        "school"     => $school
    ]);
    exit;
}
if ($method === 'POST') {
    $reg_id                     = isset($_POST['reg_id']) ? $_POST['reg_id'] : null;
    $reg_parents_name           = isset($_POST['reg_parents_name']) ? $_POST['reg_parents_name'] : null;
    $reg_parents_mobile         = isset($_POST['reg_parents_mobile']) ? $_POST['reg_parents_mobile'] : null;
    $reg_institution_type       = isset($_POST['reg_institution_type']) ? $_POST['reg_institution_type'] : null;
    $reg_grade                  = isset($_POST['reg_grade']) ? $_POST['reg_grade'] : null;
    $reg_selected_category      = isset($_POST['reg_selected_category']) ? $_POST['reg_selected_category'] : null;
    $reg_language               = isset($_POST['reg_language']) ? $_POST['reg_language'] : null;
    $reg_device_capability      = isset($_POST['reg_device_capability']) ? $_POST['reg_device_capability'] : null;
    $reg_other_institute        = isset($_POST['reg_other_institute']) ? $_POST['reg_other_institute'] : 2;
    $reg_other_institute_name   = isset($_POST['reg_other_institute_name']) ? $_POST['reg_other_institute_name'] : null;
    $reg_class                   = isset($_POST['reg_class']) && $_POST['reg_class'] !== '' ? $_POST['reg_class'] : 'NULL';
    $reg_year                   = isset($_POST['reg_year']) && $_POST['reg_year'] !== '' ? $_POST['reg_year'] : 'NULL';
    $coh_id                     = isset($_POST['coh_id']) && $_POST['coh_id'] !== '' ? $_POST['coh_id'] : 'NULL';
    $sch_id                     = isset($_POST['sch_id']) && $_POST['sch_id'] !== '' ? $_POST['sch_id'] : 'NULL';
    $dist_id                    = isset($_POST['dist_id']) && $_POST['dist_id'] !== '' ? $_POST['dist_id'] : 'NULL';

    if (empty($reg_id)) {
        $error_code = 101;
        $status     = "error";
        $message    = "reg_id is required";
        echo json_encode(["error_code"=>$error_code]);
        exit;
    }
    check_token($reg_id, $token, $conn);
    $updateQuery = "UPDATE registration_header_all SET
        reg_parents_name = '$reg_parents_name',
        reg_parents_mobile = '$reg_parents_mobile',
        reg_institution_type = '$reg_institution_type',
        reg_class = $reg_class,
        reg_grade = '$reg_grade',
        reg_year = $reg_year,
        reg_selected_category = '$reg_selected_category',
        reg_language = '$reg_language',
        reg_device_capability = '$reg_device_capability',
        reg_other_institute = '$reg_other_institute',
        reg_other_institute_name = '$reg_other_institute_name',
        coh_id = $coh_id,
        sch_id = $sch_id,
        dist_id = $dist_id,
        reg_updated_on = '$now'
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


