<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = trim($_POST['user_name']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    $role = $_POST['role'];
    $_SESSION['user_id'] = $user['user_id'];


    // Check if user already exists
    $check_query = "SELECT * FROM Users WHERE user_name = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        // Insert new user
        $insert_query = "INSERT INTO Users (user_name, password, role) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("sss", $user_name, $password, $role);
        if ($insert_stmt->execute()) {
            echo "Signup successful. Please <a href='signin_signup.html'>login</a>.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Username already exists.";
    }

    $stmt->close();
    $conn->close();
}
?>
