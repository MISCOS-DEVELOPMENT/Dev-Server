<?php
/**
 * Date     : 14-10-2025
 * API Name : Get total registrations and visitors
 * Version  : 1.1
 * Method   : GET
 * Table    : registration_header_all, factory_reset_all
 *
 * Logic part:
 *   1. Return count of registration.
 *   2. Fetch total_visitor from factory_reset_all.
 *   3. Increment by 1 and update in table.
 *   4. Return both counts in response.
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
    $conn->begin_transaction();
    $sql_reg = "SELECT COUNT(*) AS total_registrations FROM registration_header_all";
    $result_reg = $conn->query($sql_reg);
    if (!$result_reg) {
        throw new Exception("Failed to fetch registration count: " . $conn->error);
    }
    $row_reg = $result_reg->fetch_assoc();
    $total_registrations = (int)$row_reg['total_registrations'];
    $sql_vis = "SELECT total_visitor FROM factory_reset_all LIMIT 1";
    $result_vis = $conn->query($sql_vis);
    if (!$result_vis || $result_vis->num_rows === 0) {
        throw new Exception("No visitor data found in factory_reset_all");
    }
    $row_vis = $result_vis->fetch_assoc();
    $previous_visitor = (int)$row_vis['total_visitor'];
    $current_visitor = $previous_visitor + 1;
    $update = "UPDATE factory_reset_all SET total_visitor = $current_visitor";
    if (!$conn->query($update)) {
        throw new Exception("Failed to update visitor count: " . $conn->error);
    }
    $conn->commit();
    echo json_encode([
        "error_code"         => 200,
        "status"             => "success",
        "total_registrations"=> $total_registrations,
        "previous_visitor"   => $previous_visitor,
        "current_visitor"    => $current_visitor
    ]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode([
        "error_code" => 500,
        "status"     => "error",
        "message"    => "Failed to fetch data: " . $e->getMessage()
    ]);
}
?>
