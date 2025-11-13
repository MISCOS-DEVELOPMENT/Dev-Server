<?php
/**
 * Date     : 03-10-2025
 * API Name : submit_mcq_question API
 * Version  : 1.1
 * Method   : POST
 * Tables   : participant_live_exam_transaction_all, participants_header_all

* Logic part
    1. submit every question answer

* Tested 14-10-2025
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, token, mode");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(["status" => "OK - preflight"]);
    exit;
}
date_default_timezone_set('Asia/Kolkata');
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
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
$ple_id      = isset($_POST['ple_id']) ? trim($_POST['ple_id']) : "";
$par_id      = isset($_POST['par_id']) ? trim($_POST['par_id']) : "";
$correct_ans = isset($_POST['correct_ans']) ? trim($_POST['correct_ans']) : "";
$marked_ans  = isset($_POST['marked_ans']) ? trim($_POST['marked_ans']) : "";

if (empty($ple_id)) {
    echo json_encode([
        "error_code" => 100,
        "status"     => "error",
        "message"    => "Missing parameters (ple_id or reg_id)"
    ]);
    exit;
}
if (empty($marked_ans)) {
    $question_status = 3; 
} elseif ($marked_ans == $correct_ans) {
    $question_status = 1; 
} else {
    $question_status = 2; 
}

try {
    $conn->begin_transaction();
    $sql_live = "UPDATE participant_live_exam_transaction_all SET marked_ans = '$marked_ans', question_status = $question_status WHERE ple_id = $ple_id";
    if (!$conn->query($sql_live)) {
        throw new Exception("Error updating participant_live_exam_transaction_all: " . $conn->error);
    }
    $sql_header = "UPDATE participants_header_all SET last_ple_id = $ple_id WHERE par_id = $par_id";
    if (!$conn->query($sql_header)) {
        throw new Exception("Error updating participants_header_all: " . $conn->error);
    }
    $conn->commit();

    echo json_encode([
        "error_code" => 200,
        "status"     => "success",
        "message"    => "Answer recorded successfully",
    ]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode([
        "error_code" => 500,
        "status"     => "error",
        "message"    => "Transaction failed: " . $e->getMessage()
    ]);
}

$conn->close();
?>
