<?php
header('Content-Type: application/json');
echo json_encode([
    'status' => 'success',
    'message' => 'API routing is working!',
    'timestamp' => date('Y-m-d H:i:s'),
    'data' => [
        'event' => 'Yuva Sanskar Mahotsav 2025',
        'endpoint' => 'test_api.php'
    ]
]);
?>
