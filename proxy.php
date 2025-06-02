<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$number = $_GET['number'] ?? '';

if (!$number || !preg_match('/^\d{10,15}$/', $number)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid number']);
    exit;
}

$apiUrl = "https://shadowtools.site/shadowapi/api.php?number=" . urlencode($number);

$context = stream_context_create([
    'http' => [
        'timeout' => 10, // seconds
    ]
]);

$response = @file_get_contents($apiUrl, false, $context);

if ($response === FALSE) {
    echo json_encode([
        'status' => 'error',
        'message' => 'API request failed',
        'debug' => error_get_last()
    ]);
} else {
    echo $response;
}
