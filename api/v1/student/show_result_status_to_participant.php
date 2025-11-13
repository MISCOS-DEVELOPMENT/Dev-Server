<?php
/**
 * Date     : 16-10-2025
 * API Name : result_status_for_participant API
 * Version  : 1.0
 * Method   : POST
 * Tables   : participants_header_all, registration_header_all, category_header_all
    
 * Logic part
    1. Accept par_id
    2. Fetch participant + registration + category info
    3. Return full result status in JSON

* Tested 16-10-2025
 */

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, token, mode");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(["status" => "OK - preflight"]);
    exit;
}
date_default_timezone_set('Asia/Kolkata');
require_once './../../../config/db_connection.php';
require_once './../../common_function/all_common_functions.php';

$db   = DB::getInstance();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "error_code" => 203,
        "status"     => "error",
        "message"    => "Invalid request method"
    ]);
    exit;
}
$par_id = isset($_POST['par_id']) ? trim($_POST['par_id']) : "";
$reg_id = isset($_POST['reg_id']) ? trim($_POST['reg_id']) : "";
$headers     = getallheaders();
$token       = isset($headers['Authorization']) ? $headers['Authorization'] : null;
$check_session = check_token($reg_id, $token, $conn);
if (empty($par_id)) {
    echo json_encode([
        "error_code" => 100,
        "status"     => "error",
        "message"    => "Missing parameter: par_id"
    ]);
    exit;
}
try {
    $sql = "
        SELECT 
            p.par_id,
            p.par_exam_start_time,
            p.par_exam_end_time,
            r.reg_id,
            r.reg_full_name,
            r.reg_mobile,
            r.reg_email,
            r.reg_class,
            r.reg_grade,
            r.reg_institution_type,
            r.reg_selected_category,
            r.reg_gender,
            r.reg_parents_name,
            r.reg_parents_mobile,
            r.reg_phase_1,
            r.reg_phase_2,
            r.reg_phase_2,
            c.cat_id,
            c.cat_name,
            c.cat_type,
            c.cat_for,
            c.cat_stage,
            c.cat_marks,
            c.cat_result_date
        FROM participants_header_all AS p
        LEFT JOIN registration_header_all AS r ON p.reg_id = r.reg_id
        LEFT JOIN category_header_all AS c ON p.cat_id = c.cat_id
        WHERE p.par_id = '$par_id'
    ";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $response = [
            "error_code" => 200,
            "status"     => "success",
            "message"    => "Result status fetched successfully",
            "participant_details" => [
                "par_id"          => $data['par_id'],
                "par_exam_start"  => $data['par_exam_start_time'],
                "par_exam_end"    => $data['par_exam_end_time']
            ],
            "registration_details" => [
                "reg_id"               => $data['reg_id'],
                "reg_full_name"        => $data['reg_full_name'],
                "reg_mobile"           => $data['reg_mobile'],
                "reg_email"            => $data['reg_email'],
                "reg_gender"           => $data['reg_gender'],
                "reg_class"            => $data['reg_class'],
                "reg_grade"            => $data['reg_grade'],
                "reg_institution_type" => $data['reg_institution_type'],
                "reg_selected_category"=> $data['reg_selected_category'],
                "reg_parents_name"     => $data['reg_parents_name'],
                "reg_parents_mobile"   => $data['reg_parents_mobile'],
                "reg_phase_1"          => $data['reg_phase_1'],
                "reg_phase_2"          => $data['reg_phase_2'],
                "reg_phase_3"          => $data['reg_phase_3']
            ],
            "category_details" => [
                "cat_id"             => $data['cat_id'],
                "cat_name"           => $data['cat_name'],
                "cat_type"           => $data['cat_type'],
                "cat_for"            => $data['cat_for'],
                "cat_result_date"    => $data['cat_result_date'],
                "cat_result_publish" => $data['cat_result_publish'],
                "cat_stage"          => $data['cat_stage']
            ]
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } else {
        echo json_encode([
            "error_code" => 201,
            "status"     => "error",
            "message"    => "No record found for given par_id"
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "error_code" => 202,
        "status"     => "error",
        "message"    => "Exception occurred: " . $e->getMessage()
    ]);
}
?>
