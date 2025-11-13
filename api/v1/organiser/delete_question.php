<?php
/**
 * API Name : Delete Question (soft delete)
 * Version  : 1.0
 * Method   : POST
 * Table    : question_header_all
 */
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, token, mode, Authorization");
date_default_timezone_set('Asia/Kolkata');
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
$db = DB::getInstance();
$conn = $db->getConnection();
$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST') {
    echo json_encode([
        "error_code" => 102,
        "status" => "error",
        "message" => "Invalid request method"
    ]);
    exit;
}
// Get POST data
$que_id = isset($_POST['que_id']) ? intval($_POST['que_id']) : 0;
$cat_id = isset($_POST['cat_id']) ? intval($_POST['cat_id']) : 0;
if ($que_id <= 0 || $cat_id <= 0) {
    echo json_encode([
        "error_code" => 100,
        "status" => "error",
        "message" => "que_id and cat_id are required"
    ]);
    exit;
}
// Soft delete query
$updateQuery = "UPDATE question_header_all 
                SET que_status = 2 
                WHERE que_id = $que_id AND cat_id = $cat_id";
if ($conn->query($updateQuery)) {
    if ($conn->affected_rows > 0) {
        echo json_encode([
            "error_code" => 200,
            "status" => "success",
            "message" => "Question deleted successfully"
        ]);
    } else {
        echo json_encode([
            "error_code" => 201,
            "status" => "error",
            "message" => "No matching question found"
        ]);
    }
} else {
    echo json_encode([
        "error_code" => 501,
        "status" => "error",
        "message" => "Server error: " . $conn->error
    ]);
}
$conn->close();
?>
