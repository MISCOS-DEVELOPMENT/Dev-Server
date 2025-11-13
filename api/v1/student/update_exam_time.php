<?php
/**
 * Date     : 09-10-2025
 * API Name : Update Exam Time API
 * Version  : 1.1
 * Method   : POST
 * Table    : participants_header_all

* Logic part
    1. update exam time every 1 min

* Tested 14-10-2025
 */ 
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, token, mode, Authorization");
date_default_timezone_set('Asia/Kolkata');
require_once '../../../config/db_connection.php';
$db   = DB::getInstance();
$conn = $db->getConnection();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "error_code" => 203,
        "status" => "error",
        "message" => "Invalid request method"
    ]);
    exit;
}
$par_id = isset($_POST['par_id']) ? $_POST['par_id'] : null;
$min    = isset($_POST['min']) ? $_POST['min'] : 0;
if (empty($par_id) || $min == 0) {
    echo json_encode([
        "error_code" => 101,
        "status" => "error",
        "message" => "Invalid or missing parameters (par_id, min)"
    ]);
    exit;
}
try {
    $query = "UPDATE participants_header_all SET live_exam_time = '$min' WHERE par_id = $par_id";
    if (!$conn->query($query)) {
        throw new Exception($conn->error);
    }
    echo json_encode([
        "error_code" => 200,
        "status" => "success",
        "message" => "Exam time updated successfully",
        "par_id" => $par_id,
        "updated_minutes" => $min
    ]);
} catch (Exception $e) {
    echo json_encode([
        "error_code" => 501,
        "status" => "error",
        "message" => "Server error: " . $e->getMessage()
    ]);
    exit;
}
$conn->close();
?>
