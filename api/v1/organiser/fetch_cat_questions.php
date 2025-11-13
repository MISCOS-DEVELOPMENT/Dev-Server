<?php
/**
 * API Name : Fetch Questions by Category ID
 * Version  : 1.0
 * Method   : GET
 * Table    : question_header_all
 */
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, token, mode, Authorization");
date_default_timezone_set('Asia/Kolkata');
require_once './../../common_function/all_common_functions.php';
require_once './../../../config/db_connection.php';

$db   = DB::getInstance();
$conn = $db->getConnection();

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'GET') {

    $cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';

    // Missing cat_id
    if (empty($cat_id)) {
        echo json_encode([
            "error_code" => 100,
            "status"     => "error",
            "message"    => "cat_id is required"
        ]);
        exit;
    }

    // Normal SQL query
    $query = "SELECT 
                que_id,
                cat_id,
                u_id,
                que_discreption_eng,
                que_option_1_eng,
                que_option_2_eng,
                que_option_3_eng,
                que_option_4_eng,
                que_discreption_hindi,
                que_option_1_hindi,
                que_option_2_hindi,
                que_option_3_hindi,
                que_option_4_hindi,
                que_correct_option,
                que_weightage
              FROM question_header_all
              WHERE cat_id = $cat_id AND que_status = 1";

    $result = $conn->query($query);

    if (!$result) {
        echo json_encode([
            "error_code" => 501,
            "status"     => "error",
            "message"    => "Server error: " . $conn->error
        ]);
        exit;
    }

    if ($result->num_rows === 0) {
        echo json_encode([
            "error_code" => 201,
            "status"     => "error",
            "message"    => "No record found for this cat_id"
        ]);
        exit;
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode([
        "error_code" => 200,
        "status"     => "success",
        "data"       => $data
    ]);

} else {
    // Invalid method
    echo json_encode([
        "error_code" => 102,
        "status"     => "error",
        "message"    => "Invalid request method"
    ]);
}
?>
