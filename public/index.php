<?php
// Errors visible (development ke liye)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// JSON header
header("Content-Type: application/json");


// Load routes
require __DIR__ . '/../routes/index.php';
