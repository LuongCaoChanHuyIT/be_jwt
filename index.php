<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once 'app/core/Router.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$basePath = rtrim($scriptName, '/');
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}
$route = '/' . ltrim($uri, '/');

$router = new Router();
require_once 'routes.php';

$method = $_SERVER['REQUEST_METHOD'];
$router->dispatch($method, $route);