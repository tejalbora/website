<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "art_paradise";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_FILES['art_image']) && $_FILES['art_image']['error'] === UPLOAD_ERR_OK) {
    $artist = $_POST['artist'];
    $artist_id = $_POST['artist_id']; // make sure your form includes this
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description']; // make sure this is also in your form

    $imgData = file_get_contents($_FILES['art_image']['tmp_name']);

    $stmt = $conn->prepare("INSERT INTO ArtWork (art, title, artist, artist_id, price, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("bssids", $null, $title, $artist, $artist_id, $price, $description);
    $stmt->send_long_data(0, $imgData);
    $stmt->execute();

    echo "Artwork uploaded successfully!";
    $stmt->close();
} else {
    echo "Image upload failed.";
}

if ($_FILES['art_image']['size'] > 1024 * 1024 * 20) { // 20MB limit
    die("Image too large. Please upload an image smaller than 20MB.");
}

$conn->close();
?>
