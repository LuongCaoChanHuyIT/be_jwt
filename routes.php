<?php
require_once 'app/controllers/UserController.php';

$router->add('GET', '/', function () { echo json_encode(['message' => 'API is running']);});

$router->add('GET', '/users', [UserController::class, 'getAll']);
$router->add('GET', '/users/test', [UserController::class, 'test']);
?>