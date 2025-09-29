<?php
// Errors visible (development ke liye)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// JSON header
header("Content-Type: application/json");

// // Simple welcome response
// echo json_encode([
//     "message" => "Welcome to API"
// ]);

// Load routes
require __DIR__ . '/../routes/index.php';
