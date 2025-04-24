<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = "localhost";
$user = "root";
$password = "";
$dbname = "art_paradise";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure artist is logged in
if (!isset($_SESSION['user_name']) || $_SESSION['role'] !== 'seller') {
    header("Location: signin_signup.php");
    exit();
}

$artist = $_SESSION['user_name']; // Logged-in artist

// Fetch only artworks by the logged-in artist
$sql = "SELECT art_id, artist, title, price, art, description FROM ArtWork WHERE artist = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $artist);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $img = base64_encode($row['art']);
    echo "
    <div class='pro'>
        <img src='data:image/jpeg;base64,$img' alt='Artwork Image'>
        <div class='des'>
            <span>{$row['artist']}</span>
            <h5>{$row['title']}</h5>
            <h4>\${$row['price']}</h4>
            <h5>{$row['description']}</h5>
        </div>
    </div>
    ";
}

$stmt->close();
$conn->close();
?>