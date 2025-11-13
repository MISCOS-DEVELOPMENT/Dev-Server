<?php
/**
 * Date     : 04-10-2025
 * API Name : submit_mcq_final_submission API
 * Version  : 1.0
 * Method   : POST
 * Table    : participant_live_exam_transaction_all, participant_exam_submission_all

* Logic part
    1. submit exam update marks and result

* Tested 14-10-2025
 */
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
$headers = getallheaders();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "error_code" => 203,
        "status"     => "error",
        "message"    => "Invalid request method"
    ]);
    exit;
}
$par_id = isset($_POST['par_id']) ? $_POST['par_id'] : "";
if (empty($par_id)) {
    echo json_encode([
        "error_code" => 100,
        "status"     => "error",
        "message"    => "Missing parameters"
    ]);
    exit;
}
$que_details_array = [];
$que_count = 1;
$correct = 0;
$wrong   = 0;
$submitted_dt  = date("Y-m-d H:i:s");
$conn->begin_transaction();
try {
    $sql_select_live = "SELECT * FROM participant_live_exam_transaction_all WHERE par_id = $par_id";
    $result_live = $conn->query($sql_select_live);
    if ($result_live && $result_live->num_rows > 0) {
        while ($r = $result_live->fetch_assoc()) {
            if ($r['marked_ans'] == $r['correct_ans']) {
                $correct++;
            } else if($r['question_status'] == 0) {
                $wrong++;
            } else {
                $wrong++;
            }
            $que_details_array['question_'.$que_count] = [
                "que_id"      => $r['que_id'],
                "marked_ans"  => $r['marked_ans'],
                "que_status"  => $r['question_status'],
                "correct_ans" => $r['correct_ans']
            ];
            $que_count++;
        }
        $que_details_array['submitted_dt']       = $submitted_dt;
        $que_details_array['total_correct']      = $correct;
        $que_details_array['total_wrong']        = $wrong;
        $que_details_array['final_weight_score'] = $correct;
        $que_details_array['status']             = 2;
        $columns = implode(", ", array_keys($que_details_array));
        $values  = implode("', '", array_map(function($v){
            return is_array($v) ? json_encode($v, JSON_UNESCAPED_UNICODE) : $v;
        }, array_values($que_details_array)));
        $set_parts = [];
        foreach ($que_details_array as $key => $value) {
            $escaped_value = is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value;
            $set_parts[] = "$key = '" . addslashes($escaped_value) . "'";
        }
        $set_clause = implode(", ", $set_parts);
        $sql_update = "UPDATE participant_slot_questions_details_all 
               SET $set_clause 
               WHERE par_id = $par_id";
        if (!$conn->query($sql_update)) {
            throw new Exception($conn->error);
        }
        $sql_delete = "DELETE FROM participant_live_exam_transaction_all 
                       WHERE par_id = $par_id";
        if (!$conn->query($sql_delete)) {
            throw new Exception($conn->error);
        }
        $sql_complete_exam = "UPDATE participants_header_all SET par_status = 5, par_obtain_marks = $correct, par_exam_end_time = '$submitted_dt' WHERE par_id = $par_id";
        if (!$conn->query($sql_complete_exam)) {
            throw new Exception($conn->error);
        }
        $conn->commit();
        echo json_encode([
            "error_code" => 200,
            "status"     => "success",
            "message"    => "Exam submitted successfully",
            "total_correct" => $correct,
            "total_wrong"   => $wrong
        ]);
    } else {
        echo json_encode([
            "error_code" => 201,
            "status"     => "error",
            "message"    => "No live records found"
        ]);
    }
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode([
        "error_code" => 202,
        "status"     => "error",
        "message"    => "Transaction failed: " . $e->getMessage()
    ]);
}
?>
