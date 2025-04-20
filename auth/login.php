<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include '../config/db.php';  // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user credentials from the form
    $user_name = trim($_POST['user_name']);
    $password = trim($_POST['password']);

    // Prepare the query to check for the user
    $stmt = $conn->prepare("SELECT * FROM Users WHERE user_name = ?");
    $stmt->bind_param("s", $user_name); // 's' means the parameter is a string
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // If user exists and password matches
    if ($user && $password === $user['password']) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on user role
        if ($user['role'] == 'admin') {
            header("Location: ../users/admin/admin_dashboard.php");
        } elseif ($user['role'] == 'buyer') {
            header("Location: ../users/buyer/buyer_dashboard.php");
        } elseif ($user['role'] == 'seller') {
            header("Location: ../users/seller/seller_dashboard.php");
        }
        exit();
    } else {
        echo "Invalid credentials!";
    }
}
?>
