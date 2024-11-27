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
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

// Validate inputs
if (!isset($_POST['id']) || !isset($_POST['fname']) || !isset($_POST['lname']) || !isset($_POST['email'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit();
}

$userId = intval($_POST['id']);
$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

// Additional validation
if (empty($fname) || empty($lname) || !$email) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    exit();
}

try {
    // Check if email already exists for another user
    $stmt = $conn->prepare('SELECT user_id FROM users WHERE email = ? AND user_id != ?');
    $stmt->bind_param('si', $email, $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already in use']);
        exit();
    }
    $stmt->close();

    // Prepare update statement
    $stmt = $conn->prepare('UPDATE users SET fname = ?, lname = ?, email = ? WHERE user_id = ?');
    $stmt->bind_param('sssi', $fname, $lname, $email, $userId);
    $result = $stmt->execute();

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update user']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
} finally {
    $stmt->close();
}