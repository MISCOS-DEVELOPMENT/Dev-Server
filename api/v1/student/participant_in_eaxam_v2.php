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
header("Access-Control-Allow-Headers: Content-Type, token, Cat-For, mode, Authorization");
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
// $check_session = check_token($reg_id ,$token, $conn);
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
$query_for_slot_details = "SELECT s.slot_date, s.slot_start_time, c.cat_name FROM slot_details_all AS s JOIN category_header_all AS c ON s.cat_id = c.cat_id WHERE s.slot_id = $slot_id";
$result_for_slot_details = mysqli_query($conn, $query_for_slot_details);
if (mysqli_num_rows($result_for_slot_details) > 0) {
    $data = mysqli_fetch_assoc($result_for_slot_details);
    $slot_date = $data['slot_date']; 
    $slot_start_time = $data['slot_start_time']; 
    $cat_name = $data['cat_name'];
    $formatted_time = date("h:i A", strtotime($slot_start_time));
    $formatted_date = date("d-m-Y", strtotime($slot_date));
    $slot_datetime = $formatted_date . ', ' . $formatted_time;
}
$query_user = "SELECT reg_mobile, reg_email FROM registration_header_all WHERE reg_id = $reg_id";
$result_user = mysqli_query($conn, $query_user);
if (mysqli_num_rows($result_user) > 0) {
    $data_user = mysqli_fetch_assoc($result_user);
    $reg_mobile = $data_user['reg_mobile']; 
    $reg_email = $data_user['reg_email'];
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
        $sql = "SELECT que_id FROM question_header_all WHERE  cat_id = $cat_id AND que_weightage = $weight AND que_status = 1 ORDER BY RAND() LIMIT $limit";
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
    send_sms($reg_mobile, $cat_name, $slot_datetime);
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
// function send_mail($otp, $email)  {
//     $response ['email'] =  $email;
//     $response ['test'] =  'test';
//     $payload = [
//         "recipients" => [
//             [
//                 "to" => [
//                     [
//                         "email" => $email,
//                     ]
//                 ],
//                 "variables" => [
//                     "VAR1" => $otp,               ]
//             ]
//         ],
//         "from" => [
//             "email" => "geetamahotsav@mpsthapanautsav.in"
//         ],
//         "domain" => "mpsthapanautsav.in",
//         "template_id" => "geeta_otp"
//     ];
//     $ch = curl_init('https://control.msg91.com/api/v5/email/send');
//     curl_setopt_array($ch, [
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_POST => true,
//         CURLOPT_HTTPHEADER => [
//             'Content-Type: application/json',
//             'Accept: application/json',
//             'authkey: 472285A02FfvvxxWCo68e603a2P1',
//         ],
//         CURLOPT_POSTFIELDS => json_encode($payload),
//     ]);

//     $response = curl_exec($ch);
//     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//     curl_close($ch);

//     if (in_array($httpCode, [200, 202])) {
//         return true;
//     } else {
//         error_log("Pending PO Email failed: HTTP $httpCode - " . $response);
//         return false;
//     }
// }
function send_sms($mobile, $exam, $time) {
    $authKey    = "472285A02FfvvxxWCo68e603a2P1";  
    $templateId = "6909b7d23b33771a7a361942";
    // Prepare payload
    $postData = [
        "template_id" => $templateId,
        "recipients"  => [[
            "mobiles" => "91" . $mobile, 
            "var1"    => $exam,
            "var2"    => $time
        ]]
    ];
    // Initialize CURL
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://control.msg91.com/api/v5/flow/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST  => "POST",
        CURLOPT_POSTFIELDS     => json_encode($postData),
        CURLOPT_HTTPHEADER     => [
            "accept: application/json",
            "authkey: $authKey",
            "content-type: application/json"
        ],
    ]);
    // Execute
    $resp = curl_exec($curl);
    $err  = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    // Handle result
    if ($err) {
        error_log("SMS sending failed: " . $err);
        return false;
    }
    if (in_array($httpCode, [200, 202])) {
        return true;
    } else {
        error_log("SMS failed: HTTP $httpCode - " . $resp);
        return false;
    }
}
?>

