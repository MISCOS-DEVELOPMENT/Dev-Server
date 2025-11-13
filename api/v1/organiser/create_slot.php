<?php
/**
 * Date     : 30-09-2025
 * API Name : create API
 * Version  : 1.0
 * Method   : POST
 * Table    : slot_details_all, category_header_all
 */
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, token, mode, Authorization");
date_default_timezone_set('Asia/Kolkata');
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
$db = DB::getInstance();
$conn = $db->getConnection(); 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error_code" => "203", "status" => "error", "message" => "Invalid request method"]);
    exit;
}
// $slot_id                     = generate_unique_id($conn, 'slot_details_all', 996);
$cat_id                      = isset($_POST['cat_id']) ? $_POST['cat_id'] : null;
$slot_date                   = isset($_POST['slot_date']) ? $_POST['slot_date'] : null;
$slot_start_time             = isset($_POST['start_time']) ? $_POST['start_time'] : null;
$slot_end_time               = isset($_POST['end_time']) ? $_POST['end_time'] : null;
$slot_permited_participents  = isset($_POST['permited_candidate']) ? $_POST['permited_candidate'] : null;
$slot_buffer_time            = 5;
if ($cat_id) {
    $query = "SELECT cat_id, cat_name, cat_discription, cat_type, file_type, file_max_size, cat_start_dt, cat_end_dt, cat_for, cat_gender_specific, cat_created_on FROM category_header_all WHERE cat_id = $cat_id";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        if($slot_date == $data['cat_start_dt']) {
            // will used if needed
        }
        $query_for_check_slot = "SELECT slot_id FROM slot_details_all WHERE cat_id = '$cat_id' AND slot_date = '$slot_date' AND slot_start_time = '$slot_start_time'";
        $query_for_check_slot_result = mysqli_query($conn, $query_for_check_slot);

        if (mysqli_num_rows($query_for_check_slot_result) > 0) {
            echo json_encode(["error_code" => 103, "status" => "error", "message" => "for same time slot already present"]);
            exit;
        } else {
            $query_for_check_slot = "INSERT INTO slot_details_all (cat_id, slot_date, slot_start_time, slot_end_time, slot_buffer_time, slot_permited_participents, slot_status, slot_inserted_on) VALUES ('$cat_id', '$slot_date', '$slot_start_time', '$slot_end_time', '$slot_buffer_time', '$slot_permited_participents', 1, NOW())";
            $query_for_check_slot_result = mysqli_query($conn, $query_for_check_slot);

            if($query_for_check_slot_result) {
                echo json_encode(["error_code" => 200, "status" => "error", "message" => "slot created"]);
            }
        }
    } else {
        echo json_encode(["error_code" => 102, "status" => "error", "message" => "Category not found"]);
    }
} else {
    echo json_encode(["error_code" => 101, "status" => "error", "message" => "cat_id is required"]);
}




?>