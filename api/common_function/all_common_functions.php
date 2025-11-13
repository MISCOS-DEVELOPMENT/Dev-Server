<?php 
// function for generate unique id 
function generate_unique_id($conn, $table_name, $start_number) {
    $now = date("Y-m-d H:i:s");
    $result = $conn->query("SELECT uih_id_start_from, uih_current_id FROM unique_id_header_all WHERE uih_table_name = '$table_name'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_id = $row['uih_current_id'] + 1;
        $conn->query("UPDATE unique_id_header_all SET uih_current_id = $current_id, uih_updated_on = '$now' WHERE uih_table_name = '$table_name'");
    } else {
        $current_id = 1;
        $conn->query("INSERT INTO unique_id_header_all (uih_table_name, uih_id_start_from, uih_current_id, uih_inserted_on)
                      VALUES ('$table_name', $start_number, $current_id, '$now')");
    }

    $final_id = (int)($start_number * 100000000 + $current_id);
    return $final_id;
}

// function for live questions 
function generate_unique_id_for_live_que($conn, $table_name, $start_number) {
    $now = date("Y-m-d H:i:s");
    $result = $conn->query("SELECT uih_id_start_from, uih_current_id FROM unique_id_header_all WHERE uih_table_name = '$table_name'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_id = $row['uih_current_id'] + 1;
        $conn->query("UPDATE unique_id_header_all SET uih_current_id = $current_id, uih_updated_on = '$now' WHERE uih_table_name = '$table_name'");
    } else {
        $current_id = 1;
        $conn->query("INSERT INTO unique_id_header_all (uih_table_name, uih_id_start_from, uih_current_id, uih_inserted_on)
                      VALUES ('$table_name', $start_number, $current_id, '$now')");
    }
    $final_id = (int)($start_number . $current_id);
    return $final_id;
}

function check_token($reg_id, $token, $conn) {
    if (empty($token)) {
        echo json_encode([
            "error_code" => "501",
            "message" => "session expire"
        ]);
        exit;
    }
    $sql = "SELECT reg_id FROM registration_header_all WHERE reg_token_id = ? AND reg_id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode([
            "error_code" => "502",
            "message" => "Database error"
        ]);
        exit;
    }
    $stmt->bind_param("si", $token, $reg_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        echo json_encode([
            "error_code" => "501",
            "message" => "session expire"
        ]);
        exit;
    }
    $user = $result->fetch_assoc();
    return $user['reg_id'];
}

function check_reg_status($conn) {
    $sql = "SELECT reg_status FROM factory_reset_all WHERE id = 1";
    $result = $conn->query($sql);
    if (!$result) {
        echo json_encode([
            "error_code" => 502,
            "status" => "error",
            "message" => "Database error: " . $conn->error
        ]);
        exit;
    }
    if ($result->num_rows == 0) {
        echo json_encode([
            "error_code" => 404,
            "status" => "error",
            "message" => "Configuration record not found"
        ]);
        exit;
    }
    $row = $result->fetch_assoc();
    $reg_status = $row['reg_status'];
    if ($reg_status != 1) {
        echo json_encode([
            "error_code" => 203,
            "status" => "error",
            "message" => "Registration is off"
        ]);
        exit;
    }
    return true;
}
if (!function_exists('getallheaders')) {
    function getallheaders() {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                // Convert key to lowercase
                $key = strtolower(str_replace('_', '-', substr($name, 5)));
                $headers[$key] = $value;
            }
        }
        return $headers;
    }
}
function check_otp_count($conn, $mobile, $otp) {
    $today = date('Y-m-d');
    $today_time = date('Y-m-d H:i:s');
    $otp_attempt = 0; 
    $sql_factory = "SELECT otp_attempt FROM factory_reset_all WHERE id = 1"; 
    $result_factory = $conn->query($sql_factory);
    if ($result_factory && $result_factory->num_rows > 0) {
        $row_factory = $result_factory->fetch_assoc();
        $otp_attempt = (int)$row_factory['otp_attempt'];
    } else {
        echo json_encode(["error_code" => "500"]);
        exit;
    }

    $sql = "SELECT srd_id, srd_otp, COALESCE(srd_send_count,0) AS srd_send_count FROM sms_receiver_details_all WHERE srd_mobile_no = '$mobile' AND srd_send_date = '$today' LIMIT 1";
    $res = $conn->query($sql);
    if ($res === false) {
        echo json_encode(["error_code" => "500"]);
        $conn->close();
        exit;
    }

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $srd_id = (int)$row['srd_id'];
        $send_count = (int)$row['srd_send_count'];
        if ($send_count >= (int)$otp_attempt) {
            http_response_code(200);
            echo json_encode([
                "status" => false,
                "error_code" => 504,
                "limit" => $otp_attempt
            ]);
            exit;
        } else {
            $new_count = $send_count + 1;
            $updateSql = "UPDATE sms_receiver_details_all SET srd_send_count = $new_count, srd_otp = $otp, srd_last_send = '$today_time' WHERE srd_id = $srd_id";
            if ($conn->query($updateSql) === false) {
                echo json_encode(["error_code" => "500"]);
                exit;
            }
            $send_count = $new_count;
        }
    } else {
        $insertSql = "INSERT INTO sms_receiver_details_all (srd_mobile_no, srd_sms_type, srd_send_count, srd_otp, srd_send_date, srd_last_send) VALUES ('$mobile', 1, 1, $otp, '$today', '$today_time')";
        if ($conn->query($insertSql) === false) {
            echo json_encode(["error_code" => "500"]);
            exit;
        }
        $send_count = 1;
    }
    return [$otp_attempt, $send_count];
}
?>
