<?php
include 'db_config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    // 🔴 VULNERABLE SQL Query (subject to injection)
    $query = "SELECT * FROM Users WHERE user_name = '$user_name' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['user_id'];

        // 🔁 Role-based redirection
        if ($user['role'] === 'admin') {
            header("Location: admin/admin_dashboard.php");
        } elseif ($user['role'] === 'seller') {
            header("Location: seller/seller_dashboard.php");
        } elseif ($user['role'] === 'buyer') {
            header("Location: buyer/buyer_dashboard.php");
        } else {
            echo "Unknown role.";
        }
        exit();
    } else {
        echo '<script>var r=confirm("Invalid Username or Password!!!");
				if(r==true || r==false)
				{
					window.location.href = "signin_signup.php";
				}
				</script>';
    }
    mysqli_close($conn);
}
?>