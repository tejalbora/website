<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: signin_signup.html');
    exit();
}
include '../db_config.php'; // Make sure path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['art_id'])) {
    $artId = $_POST['art_id'];

    if (isset($_SESSION['user_id'])) {
        $buyerId = $_SESSION['user_id'];

        // Check for duplicate entry
        $checkSql = "SELECT * FROM Cart WHERE buyer_id = ? AND art_id = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param("ii", $buyerId, $artId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // Add to cart
            $insertSql = "INSERT INTO Cart (buyer_id, art_id) VALUES (?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bind_param("ii", $buyerId, $artId);
            $insertStmt->execute();
        }

        header("Location: cart.php"); // redirect to cart page
        exit;
    } else {
        // User not logged in
        header("Location: signin_signup.html");
        exit;
    }
}
?>