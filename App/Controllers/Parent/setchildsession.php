<?php
    // Prevent direct access
    defined('ROOTPATH') or define('ROOTPATH', __DIR__); // Define the root if not already defined

    // Session and JSON response settings
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    header('Content-Type: application/json');

    // Disable error reporting for clean JSON output in production
    ini_set('display_errors', 0);
    error_reporting(0);

    // Handle AJAX request and set the child session
    $request = json_decode(file_get_contents('php://input'), true);
    $response = [];

    if (isset($request['childName'])) {
        $_SESSION['CHILDNAME'] = $request['childName'];
        $response = ['success' => true];
    } else {
        $response = ['success' => false, 'message' => 'Child name not provided.'];
    }

    echo json_encode($response); // Output JSON response
    exit;
?>