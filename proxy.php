<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$number = isset($_GET['number']) ? $_GET['number'] : '';

if (!$number || !preg_match('/^\d{10,15}$/', $number)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid number']);
    exit;
}

$apiUrl = "https://shadowtools.site/shadowapi/api.php?number=" . urlencode($number);
$response = @file_get_contents($apiUrl);

if ($response === FALSE) {
    echo json_encode(['status' => 'error', 'message' => 'API request failed']);
} else {
    echo $response;
}
?>
