<?php
/**
 * Date     : 01-10-2025
 * API Name : dashboardam API
 * Version  : 1.1
 * Method   : POST
 * Table    : participants_header_all, category_header_all, slot_details_all

* Logic part
    1.get all active event from participants_header_all and get therir slot details from slot_details_all
    1.get all past event from participants_header_all and get therir slot details from slot_details_all
    1.get all upcomming event from category_header_all

* Tested 10-10-2025
*/
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, token, Cat-For, mode, Authorization");
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$current_time = date('H:i:s');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(["status" => "OK - preflight"]);
    exit;
}
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
$db             = DB::getInstance();
$conn           = $db->getConnection();
$headers        = getallheaders();
$token          = isset($headers['Authorization']) ? $headers['Authorization'] : null;
$cat_for        = isset($headers['Cat-For']) ? $headers['Cat-For'] : null;
$today          = date('Y-m-d');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "error_code" => "203",
        "status"     => "error",
        "message"    => "Invalid request method"
    ]);
    exit;
}
$reg_id = isset($_POST['reg_id']) ? $_POST['reg_id'] : "";
if (empty($reg_id)) {
    echo json_encode([
        "error_code" => "100",
        "status"     => "error",
        "message"    => "Missing parameters: reg_id"
    ]);
    exit;
}
$check_session = check_token($reg_id, $token, $conn);
$active_event     = [];
$past_event       = [];
$upcoming_events  = [];
try {
    $query = "SELECT ph.*, ch.cat_name, ch.cat_discription, ch.cat_type, ch.cat_for, ch.cat_start_dt, ch.cat_end_dt, ch.cat_result_date, sd.slot_date, sd.slot_start_time, sd.slot_end_time, sd.slot_buffer_time, sd.slot_permited_participents, sd.slot_booked_particepents, sd.slot_status FROM participants_header_all ph INNER JOIN category_header_all ch ON ph.cat_id = ch.cat_id INNER JOIN slot_details_all sd ON ph.slot_id = sd.slot_id WHERE ph.reg_id = $reg_id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        throw new Exception(mysqli_error($conn));
    }
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['par_status'] == 1 && ($row['slot_date'] > $today || ($row['slot_date'] == $today && $current_time < $row['slot_end_time']))) {
            $active_event[] = $row;
        } else {
            $past_event[] = $row;
        }

    }
    // Query: Fetch upcoming categories
    $query_upcoming = "SELECT cat_id, cat_name, cat_discription, cat_status, cat_type, file_type, file_max_size, cat_start_dt, cat_end_dt, cat_for FROM category_header_all WHERE cat_status != 2 AND cat_end_dt >= '$today'";
    $upcoming_result = mysqli_query($conn, $query_upcoming);
    if (!$upcoming_result) {
        throw new Exception(mysqli_error($conn));
    }
    while ($row = mysqli_fetch_assoc($upcoming_result)) {
        if($row['cat_for'] == $cat_for || $row['cat_for'] == 0) {
            $upcoming_events[] = $row;
        }
    }
    echo json_encode([
        "error_code"       => 200,
        "message"           => "get details successfully",
        "active_events"    => $active_event,
        "past_events"      => $past_event,
        "upcoming_events"  => $upcoming_events
    ]);
} catch (Exception $e) {
    echo json_encode([
        "error_code" => 201,
        "status"     => "error",
        "message"    => "Server issue: " . $e->getMessage()
    ]);
}
?>
