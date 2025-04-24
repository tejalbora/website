<?php
session_start();

// Optional: Only allow admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../signin_signup.php');
    exit();
}

include '../db_config.php';

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $conn->prepare("DELETE FROM ArtWork WHERE art_id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_artworks.php");
    exit();
}

$sql = "SELECT art_id, artist, title, price, art, description FROM ArtWork";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Artworks</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
</head>

<body>
    <section id="header">
        <a href="#"><img src="../image/aplogo.jpg" class="logo" alt=""></a>
        <ul id="navbar">
            <li><a href="admin_home.php">Home</a></li>
            <li><a class="active" href="#">Artworks</a></li>
            <li><a href="all.php">Users</a></li>
            <li><a href="../logout.php" class="login-btn">Logout</a></li>
        </ul>
    </section>

    <section class="section-p1">
        <h2>All Uploaded Artworks</h2>
        <table class="art-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><img src="data:image/jpeg;base64,<?= base64_encode($row['art']) ?>" alt="Artwork"
                                class="artwork-thumb"></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['artist']) ?></td>
                        <td>$<?= number_format($row['price'], 2) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this artwork?');">
                                <input type="hidden" name="delete_id" value="<?= $row['art_id'] ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

    <footer class="section-p1">
        <div class="copywrite">
            <p>Created by Art Paradise &copy; 2023 | All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>