<?php

require_once __DIR__ . '/utils.php';

use General\Utils;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/getSecureRandom') {
    header('Content-Type: application/json');

    $min = isset($_GET['min']) ? intval($_GET['min']) : 1;
    $max = isset($_GET['max']) ? intval($_GET['max']) : 100;

    $random = Utils::getSecureRandom($min, $max);

    echo json_encode(['random' => $random]);
} else {
    http_response_code(404);
}