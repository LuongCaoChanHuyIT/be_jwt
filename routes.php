<?php
require_once 'app/controllers/UserController.php';

$router->add('GET', '/', function () { echo json_encode(['message' => 'API is running']);});

$router->add('GET', '/users', [UserController::class, 'getAll']);
$router->add('POST', '/users/register', [UserController::class, 'register']);
$router->add('POST', '/users/login', [UserController::class, 'login']);
?>