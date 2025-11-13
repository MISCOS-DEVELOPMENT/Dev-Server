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
$par_id          = isset($_POST['par_id']) ? $_POST['par_id'] : "";
$total_exam_time = isset($_POST['total_exam_time']) ? $_POST['total_exam_time'] : "";
if (empty($par_id)) {
    echo json_encode([
        "error_code" => 100,
        "status"     => "error",
        "message"    => "Missing parameters"
    ]);
    exit;
}

$query_par = "SELECT reg_id FROM participants_header_all WHERE par_id = $par_id";
$result_par = mysqli_query($conn, $query_par);
if (mysqli_num_rows($result_par) > 0) {
    $data_par = mysqli_fetch_assoc($result_par);
    $reg_id = $data_par['reg_id'];
    $query_user = "SELECT reg_mobile, reg_email FROM registration_header_all WHERE reg_id = $reg_id";
    $result_user = mysqli_query($conn, $query_user);
    if (mysqli_num_rows($result_user) > 0) {
        $data_user = mysqli_fetch_assoc($result_user);
        $reg_mobile = $data_user['reg_mobile'];
        $reg_email = $data_user['reg_email'];
    }
}

$que_details_array = [];
$que_count = 1;
$correct = 0;
$wrong   = 0;

$low   = 0;
$mid   = 0;
$high  = 0;


$submitted_dt  = date("Y-m-d H:i:s");
$conn->begin_transaction();
try {
    $sql_select_live = "SELECT * FROM participant_live_exam_transaction_all WHERE par_id = $par_id";
    $result_live = $conn->query($sql_select_live);
    if ($result_live && $result_live->num_rows > 0) {
        while ($r = $result_live->fetch_assoc()) {
            if ($r['marked_ans'] == $r['correct_ans']) {
                switch ($r['question_weight']) {
                    case 1:
                        $low++;
                        break;
                    case 2:
                        $mid++;
                        break;
                    case 3:
                        $high++;
                        break;
                }
                $correct++;
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
        $que_details_array['total_exam_time']    = $total_exam_time;
        $que_details_array['total_correct']      = $correct;
        $que_details_array['total_wrong']        = $wrong;
        $que_details_array['final_weight_score'] = $correct;
        $que_details_array['correct_low']        = $low;
        $que_details_array['correct_mid']        = $mid;
        $que_details_array['correct_high']       = $high;
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
        send_sms($reg_mobile);
        send_mail($reg_email);
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
function send_mail($email)  {
    $response ['email'] =  $email;
    $response ['test'] =  'test';
    $payload = [
        "recipients" => [
            [
                "to" => [
                    [
                        "email" => $email,
                    ]
                ],
                "variables" => [              ]
            ]
        ],
        "from" => [
            "email" => "geetamahotsav@mpsthapanautsav.in"
        ],
        "domain" => "mpsthapanautsav.in",
        "template_id" => "geeta_exam_success"
    ];
    $ch = curl_init('https://control.msg91.com/api/v5/email/send');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Accept: application/json',
            'authkey: 472285A02FfvvxxWCo68e603a2P1',
        ],
        CURLOPT_POSTFIELDS => json_encode($payload),
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if (in_array($httpCode, [200, 202])) {
        return true;
    } else {
        error_log("Pending PO Email failed: HTTP $httpCode - " . $response);
        return false;
    }
}
function send_sms($mobile) {
    $authKey    = "472285A02FfvvxxWCo68e603a2P1";  
    $templateId = "6909b7bc87ce2961ea24e628";
    // Prepare payload
    $postData = [
        "template_id" => $templateId,
        "recipients"  => [[
            "mobiles" => "91" . $mobile
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
