<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use General\Utils;

class SecureRandomController
{
    public function getSecureRandom()
    {
        try {
            // Check if both min and max parameters are set
            if (!isset($_GET['min']) || !isset($_GET['max'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Both min and max parameters are required']);
                return; // stop execution
            }

            // Get parameters from request
            $min = (int)$_GET['min'];
            $max = (int)$_GET['max'];

            // Validate parameters
            if ($min < 0 || $max < 0 || $min > $max) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid parameters']);
                return; // stop execution
            }

            // Generate random number using Utils class
            $random_number = Utils::getSecureRandom($min, $max);

            // Return JSON response
            echo json_encode(['random_number' => $random_number]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
