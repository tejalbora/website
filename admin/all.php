<?php
session_start();
include '../db_config.php';

$query = "SELECT * FROM Users";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Users</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
</head>

<body>
    <section id="header">
        <a href="#"><img src="../image/aplogo.jpg" class="logo" alt=""></a>
        <ul id="navbar">
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a class="active" href="#">Artworks</a></li>
            <li><a href="admin_dashboard.php">NewsLetters</a></li>
            <li><a href="../logout.php" class="login-btn">Logout</a></li>
        </ul>
    </section>
    <section class="admin-panel">

        <!-- Section 1: Create New User -->
        <div class="admin-form">
            <h2>Create New User</h2>
            <form method="post" action="create_user.php" class="create-user-form">
                <input type="text" name="user_name" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="seller">Seller</option>
                    <option value="buyer">Buyer</option>
                </select>
                <button type="submit">Create User</button>
            </form>
        </div>

        <!-- Section 2: Existing Users -->
        <div class="user-table-container">
            <h2>All Users</h2>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $user['user_id'] ?></td>
                            <td><?= htmlspecialchars($user['user_name']) ?></td>
                            <td><?= $user['role'] ?></td>
                            <td>
                                <form method="post" action="delete_user.php"
                                    onsubmit="return confirm('Delete this user?');">
                                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </section>

</body>

</html>