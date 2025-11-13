<?php
/**
 * Date     : 01-10-2025
 * Updated  : 03-10-2025
 * API Name : Student login API
 * Version  : 1.0
 * Method   : POST
 * Table    : registration_header_all
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
    echo json_encode([
        "error_code" => "203",
        "status"     => "error",
        "message"    => "Invalid request method"
    ]);
    exit;
}
// variables from POST  
$u_mobile = isset($_POST['u_mobile']) ? $_POST['u_mobile'] : "";
$u_pin   = isset($_POST['u_pin']) ? $_POST['u_pin'] : "";
if (empty($u_mobile) || empty($u_pin)) {
    echo json_encode([
        "error_code" => "100",
        "status"     => "error",
        "message"    => "Missing parameters"
    ]);
    exit;
}
// generate secure token
$u_token_id = bin2hex(random_bytes(32));
// query for select
$sql = "SELECT u_id, u_name, u_email, u_mobile, u_pin, u_address u_dist, u_status FROM user_header_all WHERE u_mobile = '$u_mobile' AND u_pin = '$u_pin' AND u_type = 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $u_id = $user['u_id'];
    try {
        // start transaction
        $conn->begin_transaction();
        // update token
        $update = "UPDATE user_header_all 
                   SET u_token_id = '$u_token_id' 
                   WHERE u_id = '$u_id'";
        if (!$conn->query($update)) {
            throw new Exception("Token update failed");
        }
        // commit transaction
        $conn->commit();
        if($user['u_status'] == 1) {
            echo json_encode([
                "error_code" => 200,
                "message"    => "login successfully",
                "data"       => $user,
                "token"      => $u_token_id
            ]);
        } else {
           echo json_encode([
                "error_code" => 201,
                "message"    => "profile deactive"
            ]); 
        }
    } catch (Exception $e) {
        // rollback if any query fails
        $conn->rollback();
        echo json_encode([
            "error_code" => 500,
            "status"     => "error",
            "message"    => "Transaction failed: " . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        "error_code" => 100,
        "status"     => "error",
        "message"    => "Invalid credentials"
    ]);
}
?>
