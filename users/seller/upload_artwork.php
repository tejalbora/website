<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to upload artwork.");
}

include '../../config/db.php';

if (isset($_FILES['art_image']) && $_FILES['art_image']['error'] === UPLOAD_ERR_OK) {
    // Optional: check size limit before processing
    if ($_FILES['art_image']['size'] > 1024 * 1024 * 20) { // 20MB
        die("Image too large. Please upload an image smaller than 20MB.");
    }

    $artist = $_POST['artist'];
    $artist_id = $_SESSION['user_id'];  // Use session, not form input!
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $imgData = file_get_contents($_FILES['art_image']['tmp_name']);

    $stmt = $conn->prepare("INSERT INTO ArtWork (art, title, artist, artist_id, price, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("bssids", $null, $title, $artist, $artist_id, $price, $description);
    $stmt->send_long_data(0, $imgData);

    if ($stmt->execute()) {
        echo "Artwork uploaded successfully!";
    } else {
        echo "Upload failed: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Image upload failed.";
}

$conn->close();
?>
