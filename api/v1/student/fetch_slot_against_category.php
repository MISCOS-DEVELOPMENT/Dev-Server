<?php
/**
 * Date     : 03-10-2025
 * API Name : fetch slot API
 * Version  : 1.0
 * Method   : GET
 * Table    : slot_details_all, category_header_all

* Logic part
    1. get all slot againt cateegory

* Tested 13-10-2025
 */
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, token, cat_for, mode, Authorization");
date_default_timezone_set('Asia/Kolkata');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(["status" => "OK - preflight"]);
    exit;
}
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
$today = date('Y-m-d');
$current_time = date('H:i:s');
$db   = DB::getInstance();
$conn = $db->getConnection();
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        "error_code" => 203,
        "status"     => "error",
        "message"    => "Invalid request method"
    ]);
    exit;
}
$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : null;
if (!$cat_id) {
    echo json_encode([
        "error_code" => 101,
        "status"     => "error",
        "message"    => "cat_id is required"
    ]);
    exit;
}
$sql = "SELECT sd.slot_id, sd.slot_date, sd.slot_start_time, sd.slot_end_time, sd.slot_permited_participents, sd.slot_booked_particepents, ch.cat_id, ch.cat_type, ch.cat_permitted_que, ch.cat_total_duration, ch.cat_name, ch.cat_discription FROM slot_details_all sd INNER JOIN category_header_all ch ON sd.cat_id = ch.cat_id WHERE ch.cat_id = $cat_id AND sd.slot_status = 1 ORDER BY sd.slot_start_time";
$result = $conn->query($sql);
if (!$result) {
    echo json_encode([
        "error_code" => 201,
        "status"     => "error",
        "message"    => "Server error"
    ]);
    exit;
}
if ($result && $result->num_rows > 0) {
    $slots = [];
    while ($row = $result->fetch_assoc()) {
        $slot_start_time = $row['slot_start_time'];
        $current_timestamp = strtotime($current_time);
        $slot_start_timestamp = strtotime($slot_start_time);
        $one_hour_before = $slot_start_timestamp - 60;
        if ($row['slot_date'] > $today || ($row['slot_date'] == $today && $current_timestamp <  $one_hour_before)) {
            $slots[$row['slot_date']][] = $row;
        }
    }
    ksort($slots);
    echo json_encode([
        "error_code" => 200,
        "status"     => "success",
        "message"     => "slot found",
        "data"       => $slots
    ]);
} else {
    echo json_encode([
        "error_code" => 204,
        "status"     => "error",
        "message"    => "No slots found for this category"
    ]);
}
?>
