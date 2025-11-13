<?php
/**
 * Date     : 06-10-2025
 * API Name : Insert Category API (All Fields)
 * Version  : 1.3
 * Table    : category_header_all
 */
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, token, mode, Authorization");
date_default_timezone_set('Asia/Kolkata');
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
$db   = DB::getInstance();
$conn = $db->getConnection();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error_code" => "203", "status" => "error", "message" => "Invalid request method"]);
    exit;
}
// Generate unique category ID
// $cat_id = generate_unique_id($conn, 'category_header_all', 997);
// Collect POST data normally, defaulting to empty string
$cat_name                 = isset($_POST['cat_name']) ? $_POST['cat_name'] : '';
$cat_discription          = isset($_POST['cat_discription']) ? $_POST['cat_discription'] : '';
$cat_status               = isset($_POST['cat_status']) ? (int)$_POST['cat_status'] : 0;
$cat_type                 = isset($_POST['cat_type']) ? (int)$_POST['cat_type'] : null;
$file_type                = isset($_POST['file_type']) ? $_POST['file_type'] : '';
$file_max_size            = isset($_POST['file_max_size']) ? $_POST['file_max_size'] : '';
$cat_start_dt             = isset($_POST['cat_start_dt']) ? $_POST['cat_start_dt'] : '';
$cat_end_dt               = isset($_POST['cat_end_dt']) ? $_POST['cat_end_dt'] : '';
$cat_for                  = isset($_POST['cat_for']) ? (int)$_POST['cat_for'] : 3;
$cat_gender_specific      = isset($_POST['cat_gender_specific']) ? (int)$_POST['cat_gender_specific'] : 3;
// Questions and weightages
$cat_qubs_1               = isset($_POST['cat_qubs_1']) ? $_POST['cat_qubs_1'] : '';
$cat_qubs_2               = isset($_POST['cat_qubs_2']) ? $_POST['cat_qubs_2'] : '';
$cat_qubs_3               = isset($_POST['cat_qubs_3']) ? $_POST['cat_qubs_3'] : '';
$cat_qubs_4               = isset($_POST['cat_qubs_4']) ? $_POST['cat_qubs_4'] : '';
$cat_qubs_5               = isset($_POST['cat_qubs_5']) ? $_POST['cat_qubs_5'] : '';
$cat_qubs_6               = isset($_POST['cat_qubs_6']) ? $_POST['cat_qubs_6'] : '';
$cat_qubs_weightages_1    = isset($_POST['cat_qubs_weightages_1']) ? (int)$_POST['cat_qubs_weightages_1'] : null;
$cat_qubs_weightages_2    = isset($_POST['cat_qubs_weightages_2']) ? (int)$_POST['cat_qubs_weightages_2'] : null;
$cat_qubs_weightages_3    = isset($_POST['cat_qubs_weightages_3']) ? (int)$_POST['cat_qubs_weightages_3'] : null;
$cat_qubs_weightages_4    = isset($_POST['cat_qubs_weightages_4']) ? (int)$_POST['cat_qubs_weightages_4'] : null;
$cat_qubs_weightages_5    = isset($_POST['cat_qubs_weightages_5']) ? (int)$_POST['cat_qubs_weightages_5'] : null;
$cat_qubs_weightages_6    = isset($_POST['cat_qubs_weightages_6']) ? (int)$_POST['cat_qubs_weightages_6'] : null;
// Other numeric fields
$cat_number_of_winners    = isset($_POST['cat_number_of_winners']) ? (int)$_POST['cat_number_of_winners'] : '';
$cat_permitted_que        = isset($_POST['cat_permitted_que']) ? (int)$_POST['cat_permitted_que'] : '';
$cat_male_winner          = isset($_POST['cat_male_winner']) ? (int)$_POST['cat_male_winner'] : '';
$cat_female_winner        = isset($_POST['cat_female_winner']) ? (int)$_POST['cat_female_winner'] : '';
$cat_stage                = isset($_POST['cat_stage']) ? (int)$_POST['cat_stage'] : '';
// Dates
$cat_created_on           = date("Y-m-d H:i:s");
$cat_result_date          = isset($_POST['cat_result_date']) ? $_POST['cat_result_date'] : null;
// Instruction and duration
$cat_instruction          = isset($_POST['cat_instruction']) ? $_POST['cat_instruction'] : '';
$cat_total_duration       = isset($_POST['cat_total_duration']) ? $_POST['cat_total_duration'] : '';
$cat_marks                = isset($_POST['cat_marks']) ? $_POST['cat_marks'] : '';
// Build full INSERT query
$sql = "INSERT INTO category_header_all(cat_name, cat_discription, cat_status, cat_type,
    file_type, file_max_size, cat_start_dt, cat_end_dt,
    cat_for, cat_gender_specific,
    cat_qubs_1, cat_qubs_2, cat_qubs_3, cat_qubs_4, cat_qubs_5, cat_qubs_6,
    cat_qubs_weightages_1, cat_qubs_weightages_2, cat_qubs_weightages_3,
    cat_qubs_weightages_4, cat_qubs_weightages_5, cat_qubs_weightages_6,
    cat_number_of_winners, cat_permitted_que, cat_created_on,
    cat_male_winner, cat_female_winner, cat_instruction, cat_total_duration, cat_marks, cat_stage, cat_result_date
) VALUES (
    '$cat_name',
    '$cat_discription',
    $cat_status,
    " . (!empty($cat_type) ? $cat_type : "NULL") . ",
    '$file_type',
    '$file_max_size',
    '$cat_start_dt',
    '$cat_end_dt',
    $cat_for,
    $cat_gender_specific,
    '$cat_qubs_1', '$cat_qubs_2', '$cat_qubs_3', '$cat_qubs_4', '$cat_qubs_5', '$cat_qubs_6',
    " . (!empty($cat_qubs_weightages_1) ? $cat_qubs_weightages_1 : "NULL") . ",
    " . (!empty($cat_qubs_weightages_2) ? $cat_qubs_weightages_2 : "NULL") . ",
    " . (!empty($cat_qubs_weightages_3) ? $cat_qubs_weightages_3 : "NULL") . ",
    " . (!empty($cat_qubs_weightages_4) ? $cat_qubs_weightages_4 : "NULL") . ",
    " . (!empty($cat_qubs_weightages_5) ? $cat_qubs_weightages_5 : "NULL") . ",
    " . (!empty($cat_qubs_weightages_6) ? $cat_qubs_weightages_6 : "NULL") . ",
    " . (!empty($cat_number_of_winners) ? $cat_number_of_winners : "NULL") . ",
    " . (!empty($cat_permitted_que) ? $cat_permitted_que : "NULL") . ",
    '$cat_created_on',
    " . (!empty($cat_male_winner) ? $cat_male_winner : "NULL") . ",
    " . (!empty($cat_female_winner) ? $cat_female_winner : "NULL") . ",
    '$cat_instruction',
    '$cat_total_duration',
    '$cat_marks',
    '$cat_stage',
    '$cat_result_date'
)";

// Execute query
if (mysqli_query($conn, $sql)) {
    $cat_id = $conn->insert_id;
    echo json_encode([
        "error_code" => "200",
        "status" => "success",
        "message" => "Category inserted successfully",
        "cat_id" => $cat_id
    ]);
} else {
    echo json_encode([
        "error_code" => "201",
        "status" => "error",
        "message" => "Insert failed",
        "error" => mysqli_error($conn)
    ]);
}
// Close connection
mysqli_close($conn);
?>
