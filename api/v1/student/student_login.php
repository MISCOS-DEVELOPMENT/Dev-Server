<?php
/**
 * Date     : 01-10-2025
 * Updated  : 03-10-2025
 * API Name : Student login API
 * Version  : 1.0
 * Method   : POST
 * Table    : registration_header_all

* Logic part
    1.get user_id and pass from user and check login
    2.also calculate age group also 
*/
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
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
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "error_code" => "203",
        "status"     => "error"
    ]);
    exit;
} 
$reg_mobile = isset($_POST['reg_mobile']) ? $_POST['reg_mobile'] : "";
$reg_pass   = isset($_POST['reg_pass']) ? $_POST['reg_pass'] : "";
if (empty($reg_mobile) || empty($reg_pass)) {
    echo json_encode([
        "error_code" => "100",
        "status"     => "error"
    ]);
    exit;
}
$reg_token_id = bin2hex(random_bytes(32));
$sql = "SELECT reg_id, reg_full_name, reg_mobile, reg_email, reg_registration_no ,reg_verification_status, reg_dob, reg_institution_type, dist_id, reg_cat_for FROM registration_header_all WHERE reg_mobile = '$reg_mobile' AND reg_pass = '$reg_pass'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $reg_id = $user['reg_id'];
    $dist_id = $user['dist_id'];
    try {
        $conn->begin_transaction();
        $update = "UPDATE registration_header_all SET reg_token_id = '$reg_token_id' WHERE reg_id = $reg_id";
        if (!$conn->query($update)) {
            throw new Exception("Token update failed");
        }
        if(!empty($dist_id)) {
            $sql_dist_name = "SELECT dist_name FROM district_header_all WHERE dist_id = $dist_id";
            $result_dist_name  = mysqli_query($conn, $sql_dist_name);
            if($result_dist_name){
                $row_dist_name  = mysqli_fetch_assoc($result_dist_name);
                $dist_name = $row_dist_name['dist_name'];
            } 
        } else {
            $dist_name = '';
        }
        $user['dist_name']  = $dist_name;
        $conn->commit();
        echo json_encode([
            "error_code" => 200,
            "status"     => "success",
            "data"       => $user,
            "token"      => $reg_token_id,
            "cat_for"    => $user['reg_cat_for']
        ]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode([
            "error_code" => 500,
            "status"     => "error"
        ]);
    }
} else {
    echo json_encode([
        "error_code" => 100,
        "status"     => "error",
    ]);
}
?>
