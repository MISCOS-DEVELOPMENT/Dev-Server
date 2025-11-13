<?php
/**
 * Date     : 09-10-2025
 * API Name : Update Participant Image API
 * Version  : 1.1
 * Method   : POST
 * Table    : participants_header_all
 

* Logic part
  1. Store uswr image against every participant when he start exam

* Tested 11-10-2025
 */
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, token, mode, Authorization");
date_default_timezone_set('Asia/Kolkata');
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';
$db   = DB::getInstance();
$conn = $db->getConnection();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error_code" => 203, "status" => "error", "message" => "Invalid request method"]);
    exit;
}
$par_id     = isset($_POST['par_id']) ? $_POST['par_id'] : null;
$image_base64 = isset($_POST['image']) ? $_POST['image'] : null;
if (empty($par_id)) {
    echo json_encode(["error_code" => 101, "status" => "error", "message" => "par_id is required"]);
    exit;
}
if (empty($image_base64)) {
    echo json_encode(["error_code" => 102, "status" => "error", "message" => "image_base64 is required"]);
    exit;
}
$upload_dir = "../../../images/participant/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}
$random_num = rand(1000, 9999);
$image_name = $par_id . '_' . $random_num . '.jpg';
// $image_path = $upload_dir . $image_name;
// $image_base64 = preg_replace('#^data:image/\w+;base64,#i', '', $image_base64);
// $image_data = base64_decode($image_base64);
// if ($image_data === false) {
//     echo json_encode(["error_code" => 103, "status" => "error", "message" => "Invalid base64 image data"]);
//     exit;
// }
// if (!file_put_contents($image_path, $image_data)) {
//     echo json_encode(["error_code" => 104, "status" => "error", "message" => "Failed to save image file"]);
//     exit;
// }
$query = "UPDATE participants_header_all SET par_cadidate_image = '$image_name', par_updated_on = NOW() WHERE par_id = $par_id";
if ($conn->query($query)) {
    echo json_encode([
        "error_code" => 200,
        "status"     => "success",
        "message"    => "Participant image uploaded successfully",
        "image_path" => $image_path
    ]);
} else {
    echo json_encode([
        "error_code" => 500,
        "status"     => "error",
        "message"    => "Database update failed: " . $conn->error
    ]);
}
?>
