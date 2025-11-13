<?php
/**
 * Date     : 14-10-2025
 * API Name : Get factory reset status
 * Version  : 1.0
 * Method   : GET
 * Table    : factory_reset_all

* Logic part
    1. get status of web site , registration and login

* Tested 14-10-2025
*/
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

date_default_timezone_set('Asia/Kolkata');
require_once './../../common_function/all_common_functions.php';
require_once '../../../config/db_connection.php';

$db   = DB::getInstance();
$conn = $db->getConnection(); 

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        "error_code" => "203",
        "status"     => "error",
        "message"    => "Invalid request method"
    ]);
    exit;
}
try {
    $sql = "SELECT web_status, reg_status, login_status FROM factory_reset_all LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            "error_code" => 200,
            "status"     => "success",
            "web_status" => (int)$row['web_status'],
            "reg_status" => (int)$row['reg_status'],
            "login_status" => (int)$row['login_status']
        ]);
    } else {
        echo json_encode([
            "error_code" => 404,
            "status"     => "error",
            "message"    => "No factory reset status found"
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "error_code" => 500,
        "status"     => "error",
        "message"    => "Failed to fetch factory reset status: " . $e->getMessage()
    ]);
}
?>
