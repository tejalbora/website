<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "art_paradise";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT art_id, artist, title, price, art FROM ArtWork";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $img = base64_encode($row['art']);
    echo "
    <div class='pro'>
        <img src='data:image/jpeg;base64,$img' alt='Artwork Image'>
        <div class='des'>
            <span>{$row['artist']}</span>
            <h5>{$row['title']}</h5>
            <h4>\${$row['price']}</h4>
        </div>
        <a href='#'><i class='fa-solid fa-cart-shopping cart'></i></a>
    </div>
    ";
}

$conn->close();
?>
