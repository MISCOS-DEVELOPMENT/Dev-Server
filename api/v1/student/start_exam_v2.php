<?php
/**
 * API Name : Start Exam (via Stored Procedure)
 * Version  : 1.3
 * Method   : POST
 * Procedure: start_exam_procedure
 *
 * Logic Flow:
 *   1. Get participant ID (par_id)
 *   2. Call stored procedure (handles all cases)
 *   3. If exam already submitted → return 504 (handled safely)
 *   4. If exam already started → resume
 *   5. If not started → initialize questions
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, token, mode, Authorization");
date_default_timezone_set('Asia/Kolkata');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
$db   = DB::getInstance();
$conn = $db->getConnection();
$conn->query("SET time_zone = '+05:30'");
function handleMySQLError($conn)
{
    $error_message = $conn->error;
    $errno = $conn->errno;

    // Exam already submitted (504)
    if ($errno == 504 || str_contains($error_message, 'Exam already submitted')) {
        http_response_code(200);
        echo json_encode([
            "error_code" => 504,
            "status"     => "exam_submitted",
            "message"    => "Exam already submitted"
        ]);
    }
    // Invalid participant ID
    elseif (str_contains($error_message, 'Invalid participant ID')) {
        http_response_code(200);
        echo json_encode([
            "error_code" => 404,
            "status"     => "error",
            "message"    => "Invalid participant ID"
        ]);
    }
    // Other SQL errors
    else {
        http_response_code(500);
        echo json_encode([
            "error_code" => $errno ?: 500,
            "status"     => "error",
            "message"    => $error_message
        ]);
    }

    exit;
}
if (empty($_POST['par_id'])) {
    http_response_code(400);
    echo json_encode([
        "error_code" => 400,
        "status"     => "error",
        "message"    => "Missing parameter: par_id"
    ]);
    exit;
}

$par_id = intval($_POST['par_id']);
$sql    = "CALL start_exam_procedure($par_id)";
$questions = [];
$question_details = [];
if (!$conn->multi_query($sql)) {
    handleMySQLError($conn);
}

// Catch errors immediately
if ($conn->errno) {
    handleMySQLError($conn);
}
if ($result = $conn->store_result()) {
    $firstRow = $result->fetch_assoc();

    // Check if this is an error row returned from procedure
    if (isset($firstRow['error_code'])) {
        http_response_code(200);
        echo json_encode([
            "error_code" => intval($firstRow['error_code']),
            "status"     => $firstRow['error_code'] == 504 ? "exam_submitted" : "error",
            "message"    => $firstRow['message']
        ]);
        exit;
    }

    // If not error, push first row
    $questions[] = $firstRow;

    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
    $result->free();
}
if ($conn->more_results()) {
    $conn->next_result();
    if ($conn->errno) {
        handleMySQLError($conn);
    }

    if ($result = $conn->store_result()) {
        while ($row = $result->fetch_assoc()) {
            $question_details[] = $row;
        }
        $result->free();
    }
}

// Clear extra result sets if any
while ($conn->more_results() && $conn->next_result()) {
    if ($extra_result = $conn->store_result()) {
        $extra_result->free();
    }
}
$restart_time = 0;
$last_que     = 0;
$sql_status = "
    SELECT h.live_exam_time, h.last_ple_id, s.status
    FROM participants_header_all h
    JOIN participant_slot_questions_details_all s 
    ON h.par_id = s.par_id
    WHERE h.par_id = $par_id
";
$res_status = $conn->query($sql_status);
if ($res_status && $res_status->num_rows > 0) {
    $row_status = $res_status->fetch_assoc();
    if ($row_status['status'] == 3) {
        $restart_time = $row_status['live_exam_time'];
        $last_que     = $row_status['last_ple_id'];
    }
}
http_response_code(200);
echo json_encode([
    "error_code"       => 200,
    "status"           => "success",
    "questions"        => $questions,
    "question_details" => $question_details,
    "exam_status"      => 1,
    "restart_time"     => $restart_time,
    "last_que"         => $last_que
]);

// $secret_key = 'c87a9e76a9e5e54f3ab86a9a7071cfbd2c3bdf51e64640f0e75b53b8d54b87a2'; 

// // Your actual response array
// $response = [
//     "error_code"       => 200,
//     "status"           => "success",
//     "questions"        => $questions,
//     "question_details" => $question_details,
//     "exam_status"      => 1,
//     "restart_time"     => $restart_time,
//     "last_que"         => $last_que
// ];

// // Convert response to JSON
// $jsonData = json_encode($response);

// // Generate IV (16 bytes for AES-256-CBC)
// $iv = openssl_random_pseudo_bytes(16);

// // Encrypt data
// $encrypted = openssl_encrypt($jsonData, 'AES-256-CBC', $secret_key, OPENSSL_RAW_DATA, $iv);

// // Encode IV + ciphertext to base64 for transmission
// $encoded = base64_encode($iv . $encrypted);

// // Send response
// http_response_code(200);
// echo json_encode([
//     "data" => $encoded
// ]);

exit;
?>
