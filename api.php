<?php  

require_once 'utils.php'; // Include Utils class  

header("Content-Type: application/json");  

// Check if running in CLI  
if (php_sapi_name() === 'cli') {  
    echo json_encode(['error' => 'This script must be run from a web server.']);  
    exit;  
}  

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {  
    http_response_code(405); // Method Not Allowed  
    echo json_encode(['error' => 'Only GET method is allowed.']);  
    exit;  
}  

// Add debug line to check GET parameters  
var_dump($_GET); // Check what parameters are available  

// Sanitize and validate inputs  
$min = isset($_GET['min']) ? (int)$_GET['min'] : null;  
$max = isset($_GET['max']) ? (int)$_GET['max'] : null;  

if ($min === null || $max === null) {  
    http_response_code(400); // Bad Request  
    echo json_encode(['error' => 'Missing required parameters "min" and "max".']);  
    exit;  
}  

if ($min > $max) {  
    http_response_code(400); // Bad Request  
    echo json_encode(['error' => '"min" cannot be greater than "max".']);  
    exit;  
}  

try {  
    // Ensure min and max are sanitized  
    $randomNumber = utils::getSecureRandom($min, $max);  
    echo json_encode(['random_number' => $randomNumber]);  
} catch (Exception $e) {  
    http_response_code(500); // Internal Server Error  
    echo json_encode([  
        'error' => 'Internal server error.',  
        'details' => $e->getMessage()  
    ]);  
}  

?>