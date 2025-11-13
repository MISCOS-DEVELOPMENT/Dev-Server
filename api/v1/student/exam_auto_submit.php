<?php
/**
 * Date     : 12-11-2025
 * Cron Job : Auto submit exams with status = 3
 * Table    : participant_slot_questions_details_all, participant_live_exam_transaction_all, participants_header_all
 */
date_default_timezone_set('Asia/Kolkata');
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';

$db   = DB::getInstance();
$conn = $db->getConnection();

try {
    // Get all exams with status = 3
    $sql_pending = "SELECT par_id FROM participant_slot_questions_details_all WHERE status = 3";
    $result_pending = $conn->query($sql_pending);
    if ($result_pending && $result_pending->num_rows > 0) {
        while ($row = $result_pending->fetch_assoc()) {
            $par_id = $row['par_id'];
            // Get live_exam_time from participants_header_all
            $sql_time = "SELECT reg_id, live_exam_time FROM participants_header_all WHERE par_id = $par_id";
            $result_time = $conn->query($sql_time);
            $total_exam_time = 0;
           if ($result_time && $result_time->num_rows > 0) {
                $data = $result_time->fetch_assoc();
                $total_exam_time = $data['live_exam_time'];
                $reg_id = $data['reg_id'];
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
                echo $result_live->num_rows;
                if ($result_live && $result_live->num_rows > 0) {
                    while ($r = $result_live->fetch_assoc()) {
                        if ($r['marked_ans'] == $r['correct_ans']) {
                            switch ($r['question_weight']) {
                                case 1: $low++; break;
                                case 2: $mid++; break;
                                case 3: $high++; break;
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
                    $set_parts = [];
                    foreach ($que_details_array as $key => $value) {
                        $escaped_value = is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value;
                        $set_parts[] = "$key = '" . addslashes($escaped_value) . "'";
                    }
                    $set_clause = implode(", ", $set_parts);
                    $sql_update = "UPDATE participant_slot_questions_details_all 
                                   SET $set_clause 
                                   WHERE par_id = $par_id";
                    if (!$conn->query($sql_update)) throw new Exception($conn->error);
                    $sql_delete = "DELETE FROM participant_live_exam_transaction_all WHERE par_id = $par_id";
                    if (!$conn->query($sql_delete)) throw new Exception($conn->error);
                    $sql_complete_exam = "UPDATE participants_header_all 
                                         SET par_status = 5, par_obtain_marks = $correct, par_exam_end_time = '$submitted_dt' 
                                         WHERE par_id = $par_id";
                    if (!$conn->query($sql_complete_exam)) throw new Exception($conn->error);
                    $conn->commit();
                    send_sms($reg_mobile);
                    send_mail($reg_email);
                    echo "Exam submitted successfully for par_id: $par_id \n";
                } else {
                    echo "No live records found for par_id: $par_id \n";
                }
            } catch (Exception $e) {
                $conn->rollback();
                echo "Transaction failed for par_id: $par_id - " . $e->getMessage() . "\n";
            }
        }
    } else {
        echo "No exams with status = 3 found\n";
    }
} catch (Exception $e) {
    echo "Cron job failed: " . $e->getMessage() . "\n";
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
