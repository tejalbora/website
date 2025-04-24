<?php
// payment_success.php

// Razorpay keys
$razorpay_key = "rzp_test_TReMcQAljlSBJh"; // Your Razorpay API key
$razorpay_secret = "EDPJ1457rYeXfw6lDFhiAlEq"; // Your Razorpay API secret

if (isset($_GET['payment_id']) && isset($_GET['order_id']) && isset($_GET['signature']) && isset($_GET['art_id'])) {
    $payment_id = $_GET['payment_id'];
    $order_id = $_GET['order_id'];
    $signature = $_GET['signature'];
    $art_id = $_GET['art_id'];

    // Verify the payment signature (insecure check for demo)
    $data = $order_id . "|" . $payment_id;
    $generated_signature = hash_hmac('sha256', $data, $razorpay_secret);

    if ($generated_signature == $signature) {
        // Include DB connection
        include '../../config/db.php'; 

        // Mark artwork as sold
        $sql = "UPDATE ArtWorks SET is_sold=1 WHERE art_id = $art_id";
        if ($conn->query($sql) === TRUE) {
            echo "Payment successful! Artwork has been marked as sold.";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Payment verification failed. Please try again.";
    }
} else {
    echo "Invalid payment details.";
}
?>