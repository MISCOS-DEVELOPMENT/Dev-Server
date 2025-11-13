<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data['u_name']) && !empty($data['u_dist'])) {
    $_SESSION['u_id'] = $data['u_id'];
    $_SESSION['u_name'] = $data['u_name'];
    $_SESSION['u_dist'] = $data['u_dist'];
    $_SESSION['u_email'] = $data['u_email'] ?? '';
    $_SESSION['u_mobile'] = $data['u_mobile'] ?? '';

    echo json_encode(["status" => "success", "message" => "Session set successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Missing required parameters"]);
}
?>
