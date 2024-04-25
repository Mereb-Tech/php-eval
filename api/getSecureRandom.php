<?php

require_once '../src/middlewares/header.php';
require_once '../src/controller/SecureRandomController.php';

$secureRandomController = new SecureRandomController();

// Call the getSecureRandom method to generate secure random number
$secureRandomController->getSecureRandom();
