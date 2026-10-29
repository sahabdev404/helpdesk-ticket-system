<?php
require_once __DIR__ . '/../app/model/Database.php';

try {
    $database = new Database();
    $pdo = $database->connect();

    echo 'Database Connected Successfully!';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    exit;
}

require_once __DIR__ . '/../app/controller/HomeController.php';

$routes = require __DIR__ . '/../routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = '/helpdesk-ticket-system/public';

$path = substr($uri, strlen($basePath));
$path = '/' . trim($path, '/');

if ($path === '//') {
    $path = '/';
}

if (isset($routes[$path])) {
    $route = $routes[$path];

    $controller = new $route['controller']();
    $method = $route['method'];

    $controller->$method();
} else {
    http_response_code(404);
    echo '404 - Page Not Found';
}




