<?php

require_once '../src/middlewares/header.php';
require_once '../src/controller/SecureRandomController.php';

$secureRandomController = new SecureRandomController();
$secureRandomController->getSecureRandom();
