<?php
ini_set('display_errors', 1);   // Show errors on screen
ini_set('display_startup_errors', 1); // Show startup errors
error_reporting(E_ALL);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, token, mode, Authorization");
date_default_timezone_set('Asia/Kolkata');
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';

$db   = DB::getInstance();
$conn = $db->getConnection();

// Token check
$headers = getallheaders();
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        "error_code" => 203,
        "status"     => "error",
        "message"    => "Invalid request method"
    ]);
    exit;
}

// Optional cat_id filter
$cat_id = isset($_GET['cat_id']) ? mysqli_real_escape_string($conn, $_GET['cat_id']) : null;

// Category query
$sql = "SELECT 
    cat_id, cat_name, cat_discription, cat_status, cat_type,
    file_type, file_max_size, cat_start_dt, cat_end_dt,
    cat_for, cat_gender_specific,
    cat_qubs_1, cat_qubs_2, cat_qubs_3, cat_qubs_4, cat_qubs_5, cat_qubs_6,
    cat_qubs_weightages_1, cat_qubs_weightages_2, cat_qubs_weightages_3,
    cat_qubs_weightages_4, cat_qubs_weightages_5, cat_qubs_weightages_6,
    cat_number_of_winners, cat_permitted_que, cat_created_on,
    cat_male_winner, cat_female_winner, cat_instruction, cat_total_duration
FROM category_header_all";

if ($cat_id) {
    $sql .= " WHERE cat_id = '$cat_id'";
}

$result = $conn->query($sql);

if (!$result) {
    echo json_encode([
        "error_code" => 201,
        "status"     => "error",
        "message"    => "Server error"
    ]);
    exit;
}

if ($result->num_rows > 0) {
    $categories = [];

    while ($row = $result->fetch_assoc()) {
        // Fetch slots for this category
        $sql_slot = "SELECT sd.slot_id, sd.slot_date, sd.slot_start_time, sd.slot_end_time, sd.slot_permited_participents, sd.slot_booked_particepents 
                     FROM slot_details_all sd 
                     WHERE sd.cat_id = '{$row['cat_id']}' AND sd.slot_status = 1";

        $result_slot = $conn->query($sql_slot);
        $slots = [];
        $slot_count = 0;

        if ($result_slot && $result_slot->num_rows > 0) {
            while ($row_slot = $result_slot->fetch_assoc()) {
                $slots[] = $row_slot;
                $slot_count++;
            }
        }

        $categories[] = [
            "category"   => $row,
            "slots"      => $slots,
            "slot_count" => $slot_count
        ];
    }

    echo json_encode([
        "error_code" => 200,
        "status"     => "success",
        "message"    => "Categories found",
        "data"       => $categories
    ]);
} else {
    echo json_encode([
        "error_code" => 204,
        "status"     => "error",
        "message"    => "No categories found"
    ]);
}
?>
