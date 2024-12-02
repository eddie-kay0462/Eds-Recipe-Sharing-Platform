<?php
//inclide code to report errors. like error reporting and display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);
 
header('Content-Type: application/json');
require '../db/config2.php';
session_start();

// Check if user is logged in and has admin privileges
if (!isset($_SESSION['user']) || $_SESSION['role'] != 1) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

// Validate user ID
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
    exit();
}

$userId = intval($_POST['id']);

try {
    // Prevent deleting the last admin
    $stmt = $conn->prepare('SELECT COUNT(*) as admin_count FROM users WHERE role = 1');
    $stmt->execute();
    $result = $stmt->get_result();
    $adminCount = $result->fetch_assoc()['admin_count'];
    $stmt->close();

    // Check if this user is the last admin
    $stmt = $conn->prepare('SELECT role FROM users WHERE user_id = ?');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user['role'] == 1 && $adminCount <= 1) {
        echo json_encode(['success' => false, 'message' => 'Cannot delete the last admin']);
        exit();
    }

    // Prepare delete statement
    $stmt = $conn->prepare('DELETE FROM users WHERE user_id = ?');
    $stmt->bind_param('i', $userId);
    $result = $stmt->execute();

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete user']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
} finally {
    $stmt->close();
}