<?php

use General\Utils;

class SecureRandomController
{
    public function getSecureRandom()
    {
        // Get parameters from request (if any)
        $min = isset($_GET['min']) ? (int)$_GET['min'] : 0;
        $max = isset($_GET['max']) ? (int)$_GET['max'] : PHP_INT_MAX;

        // Validate parameters
        if ($min < 0 || $max < 0 || $min > $max) {
            http_response_code(400);
            return json_encode(['error' => 'Invalid parameters']);
        }

        // Generate random number
        $random_number = Utils::getSecureRandom($min, $max);

        // Return JSON response
        return json_encode(['random_number' => $random_number]);
    }
}
