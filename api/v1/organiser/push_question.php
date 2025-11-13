<?php
/**
 * API Name : Import Questions from Excel
 * Version  : 1.1
 * Method   : POST (file upload)
 * Table    : question_header_all
 * 

* Logic part
    1. Get excel from user and upload againse cat_id

* Tested 11-10-2025
 */
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, token, mode, Authorization");
date_default_timezone_set('Asia/Kolkata');
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
require '../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
$db = DB::getInstance();
$conn = $db->getConnection(); 
if (!isset($_FILES['file']['tmp_name'])) {
    echo json_encode(["status" => "error", "message" => "Excel file is required"]);
    exit;
}
$filePath = $_FILES['file']['tmp_name'];
$cat_id   = isset($_POST['cat_id']) ? $_POST['cat_id'] : null;  
$u_id     = isset($_POST['user_id']) ? $_POST['user_id'] : 1  ;
$push_questions = 0;
$not_push_questions = 0;
try {
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();
    $expectedHeaders = [
        'sr.no.', 'Que-eng', 'Que-hindi', 
        'English-A(option)', 'English-B(option)', 'English-C(option)', 'English-D(option)', 
        'Hindi-A(option)', 'Hindi-B(option)', 'Hindi-C(option)', 'Hindi-D(option)', 
        'Ans(A/B/C/D)', 'Que-weightage (1:low, 2:medium,3:high)'
    ];
    $headerRow = array_map('trim', $rows[0]);
    for ($i = 0; $i < count($expectedHeaders); $i++) {
        if (strtolower($headerRow[$i]) != strtolower($expectedHeaders[$i])) {
            echo json_encode(["status" => "error", "message" => "Invalid Excel header format at column ".($i+1)." expected '".$expectedHeaders[$i]."'"]);
            exit;
        }
    }
    $conn->begin_transaction(); 
    $isFirstRow = true;
    foreach ($rows as $row) {
        if ($isFirstRow) { 
            $isFirstRow = false; 
            continue; 
        }
        $que_discreption_eng   = $conn->real_escape_string($row[1] ?? '');
        $que_option_1_eng      = $conn->real_escape_string($row[3] ?? '');
        $que_option_2_eng      = $conn->real_escape_string($row[4] ?? '');
        $que_option_3_eng      = $conn->real_escape_string($row[5] ?? '');
        $que_option_4_eng      = $conn->real_escape_string($row[6] ?? '');
        $que_discreption_hindi = $conn->real_escape_string($row[2] ?? '');
        $que_option_1_hindi    = $conn->real_escape_string($row[7] ?? '');
        $que_option_2_hindi    = $conn->real_escape_string($row[8] ?? '');
        $que_option_3_hindi    = $conn->real_escape_string($row[9] ?? '');
        $que_option_4_hindi    = $conn->real_escape_string($row[10] ?? '');
        $que_correct_option    = $conn->real_escape_string($row[11] ?? '');
        $que_weightage         = $row[12] ?? 1;
        if (!in_array($que_correct_option, ['A','B','C','D']) || !in_array($que_weightage, [1,2,3])) {
            $not_push_questions++;
            continue; 
        }
        $insertQuery = "INSERT INTO question_header_all (cat_id, u_id, que_discreption_eng, que_option_1_eng, que_option_2_eng, que_option_3_eng, que_option_4_eng, que_discreption_hindi, que_option_1_hindi, que_option_2_hindi, que_option_3_hindi, que_option_4_hindi,que_correct_option, que_weightage) VALUES ($cat_id, $u_id, '$que_discreption_eng','$que_option_1_eng', '$que_option_2_eng', '$que_option_3_eng', '$que_option_4_eng', '$que_discreption_hindi', '$que_option_1_hindi','$que_option_2_hindi', '$que_option_3_hindi', '$que_option_4_hindi', '$que_correct_option', $que_weightage)";
        if (!$conn->query($insertQuery)) {
            $conn->rollback(); 
            echo json_encode(["status" => "error", "message" => "Insert failed: " . $conn->error]);
            exit;
        }
        $push_questions++;
    }
    $countQuery = "SELECT COUNT(que_id) AS total_questions FROM question_header_all WHERE cat_id = $cat_id";
    $result = $conn->query($countQuery);
    if ($result) {
        $row = $result->fetch_assoc();
        if ($row['total_questions'] >= 60) {
            $conn->query("UPDATE category_header_all SET cat_status = 1 WHERE cat_id = $cat_id");
        }
    }
    $conn->commit(); 
    echo json_encode([
        "error_code" => 200,
        "status" => "success",
        "push_questions" => $push_questions,
        "not_push_questions" => $not_push_questions,
        "message" => "Questions imported successfully"
    ]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(["error_code" => 501, "status" => "error", "message" => $e->getMessage()]);
}
$conn->close();
?>
