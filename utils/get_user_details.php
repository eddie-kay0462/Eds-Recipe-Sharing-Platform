<?php
//inclide code to report errors. like error reporting and display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
require '../db/config.php';
session_start();

// Check if user is logged in and has admin privileges
if (!isset($_SESSION['user']) || $_SESSION['role'] != 1) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized access']);
    exit();
}

// Validate user ID
if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid user ID']);
    exit();
}

$userId = intval($_GET['user_id']);

try {
    // Prepare statement to fetch user details
    $stmt = $conn->prepare('SELECT user_id, fname, lname, email, role FROM users WHERE user_id = ?');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        http_response_code(404);
        echo json_encode(['error' => 'User not found']);
        exit();
    }

    $user = $result->fetch_assoc();
    echo json_encode($user);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
} finally {
    $stmt->close();
}