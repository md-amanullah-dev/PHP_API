<?php
$pdo = require __DIR__ . '/../config/database.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// include route groups
require_once __DIR__ . '/userRoute.php';

// Root route (welcome)
if ($uri === '/' || $uri === '') {
    echo json_encode([
        "message" => "Welcome to API"
    ]);
    return;
}

// Try matching route group by group
if (userRoute($pdo, $uri)) return;

// If no route matched → 404
http_response_code(404);
echo json_encode(["message" => "Route not found"]);
