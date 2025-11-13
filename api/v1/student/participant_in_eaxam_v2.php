<?php
/**
 * Date     : 15-10-2025
 * API Name : Participant in Exam v2 Add API
 * Version  : 1.0
 * Method   : POST
 * Table    : participants_header_all
 *
 * Logic part
    1. allow to candidate to participate in exam aloocate question to participant
 
 * Tested 14-10-2025
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, token, mode, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(["status" => "OK - preflight"]);
    exit;
}
date_default_timezone_set('Asia/Kolkata');
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
$db          = DB::getInstance();
$conn        = $db->getConnection(); 
$headers     = getallheaders(); 
$token       = isset($headers['Authorization']) ? $headers['Authorization'] : null;
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "error_code" => "203",
        "status" => "error",
        "message" => "Invalid request method"
    ]);
    exit;
}
$par_id             = isset($_POST['par_id']) ? $_POST['par_id'] : null;
$reg_id             = isset($_POST['reg_id']) ? $_POST['reg_id'] : null;
$cat_id             = isset($_POST['cat_id']) ? $_POST['cat_id'] : null;
$slot_id            = isset($_POST['slot_id']) ? $_POST['slot_id'] : null;
$par_update_count   = isset($_POST['slot_id']) ? $_POST['slot_id'] : null;
$check_session = check_token($reg_id ,$token, $conn);
$query_for_check_partcipant = "SELECT par_id FROM participants_header_all WHERE cat_id = $cat_id AND reg_id = $reg_id";
$query_for_check_partcipant_result = mysqli_query($conn, $query_for_check_partcipant);
if (mysqli_num_rows($query_for_check_partcipant_result) > 0) {
    echo json_encode([
        "error_code" => "204",
        "status"     => "participant",
        "message"    => "already participant"
    ]);
    exit;
}
$query_for_get_slot = "SELECT slot_booked_particepents, slot_permited_participents FROM slot_details_all WHERE slot_id = $slot_id";
$query_for_get_slot_result = mysqli_query($conn, $query_for_get_slot);
if($query_for_get_slot_result && mysqli_num_rows($query_for_get_slot_result) > 0){
    $query_for_get_slot_row = mysqli_fetch_assoc($query_for_get_slot_result);
    $currentBooked = $query_for_get_slot_row['slot_booked_particepents'];
    $permited_participents = $query_for_get_slot_row['slot_permited_participents'];
    if($currentBooked === $permited_participents) {
        echo json_encode([
        "error_code" => "205",
        "status"     => "full",
        "message"    => "slot full"
        ]);
        exit;
    }
} 
$query = "SELECT cat_id, cat_name, cat_discription, cat_type, file_type, file_max_size, cat_start_dt, cat_end_dt, cat_for, cat_gender_specific, cat_created_on, cat_permitted_que FROM category_header_all WHERE cat_id = $cat_id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $cat_permitted_que = $data['cat_permitted_que'];
}
$par_id = generate_unique_id($conn, 'participants_header_all', 995);
$par_inserted_on = date("Y-m-d H:i:s");
$par_status = 1;
$conn->begin_transaction(); 
try {
    $sql = "INSERT INTO participants_header_all (reg_id, slot_id, cat_id, par_status, par_inserted_on) VALUES ('$reg_id', '$slot_id', '$cat_id', '$par_status', '$par_inserted_on')";
    if (!$conn->query($sql)) {
        throw new Exception("Participant insert failed: " . $conn->error);
    } else {
        $par_id = $conn->insert_id;
    }
    function getQuestions($conn, $cat_id, $weight, $limit) {
        $questions = [];
        $sql = "SELECT que_id FROM question_header_all WHERE cat_id = $cat_id AND que_weightage = $weight AND que_status = 1 ORDER BY RAND() LIMIT $limit";
        $result = $conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $questions[] = $row['que_id'];
            }
        }
        return $questions;
    }
    $tot_w = floor($cat_permitted_que / 3);
    $desired = [1 => 33, 2 => 33, 3 => 34]; 
    $selected_questions = [];
    foreach ($desired as $weight => $count) {
        $qs = getQuestions($conn, $cat_id, $weight, $count);
        $selected_questions = array_merge($selected_questions, $qs);
    }
    $total_needed = $cat_permitted_que - count($selected_questions);
    if ($total_needed > 0) {
        $exclude_ids = implode(',', $selected_questions ?: [0]);
        $sql = "SELECT que_id FROM question_header_all WHERE cat_id = $cat_id AND que_status = 1 AND que_id NOT IN ($exclude_ids) ORDER BY RAND() LIMIT $total_needed";
        $result = $conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $selected_questions[] = $row['que_id'];
            }
        }
    }
    while (count($selected_questions) < $cat_permitted_que) {
        $selected_questions[] = null;
    }
    $columns = [];
    for ($i = 1; $i <= $cat_permitted_que; $i++) {
        $columns["question_$i"] = $selected_questions[$i-1] ?? null;
    }
    $applied_on = date("Y-m-d H:i:s");
    $status = 1; 
    $col_names = implode(",", array_keys($columns));
    $col_values = "'" . implode("','", array_map(function($val){ return $val ?? ''; }, array_values($columns))) . "'";
    $sql = "INSERT INTO participant_slot_questions_details_all (par_id, slot_id, cat_id, date_of_exam, applied_on, status, $col_names) VALUES ($par_id, $slot_id, $cat_id, now(), '$applied_on', '$status', $col_values)";
    if (!$conn->query($sql)) {
        throw new Exception("Question insert failed: " . $conn->error);
    }
    $newBooked = $currentBooked + 1;
    $updateQuery = "UPDATE slot_details_all SET slot_booked_particepents = $newBooked WHERE slot_id = $slot_id";
    if (!$conn->query($updateQuery)) {
        throw new Exception("Slot update failed: " . $conn->error);
    }
    $conn->commit(); 
    $response =[
        "error_code" => "200",
        "status" => "success",
        "message" => "Participated successfully",
        "par_id" => $par_id,
    ];
} catch (Exception $e) {
    $conn->rollback();
    $response =[
        "error_code" => "101",
        "status" => "error",
        "message" => $e->getMessage()
    ];
}
$conn->close();
echo json_encode($response);
?>

