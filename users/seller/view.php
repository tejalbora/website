<?php
session_start();

// Optional: Only allow logged-in sellers
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../../login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Art - Seller Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
</head>

<body>
    <section id="header">
        <a href="#"><img src="image/aplogo.jpg" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="#">Home</a></li>
                <li><a href="seller_dashboard.php">Upload</a></li>
                <li><a href="#news">About</a></li>
                <li><a href="#news">Contact us</a></li>
                 <!-- Show login/logout links based on user session -->
                 <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="profile.php">Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?></a></li>
                    <li><a href="logout.php" class="login-btn">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.html" class="login-btn">Login</a></li>
                    <li><a href="signup.html" class="signup-btn">Signup</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </section>

    <section id="hero">
        <a href="#"><img src="image/cover.jpg" class="cover" alt=""></a>
        <h4>Empowering artists to sell, share, and succeed.</h4>
        <h1>Art Paradise</h1>
        <p>Purpose of art is a mystery!</p>
        <button>Sell Now</button>
    </section>

    <section id="feature" class="section-p1">
        <div class="feature_box">
            <img src="image/upload.png" class="fea_logo" alt="">
            <h6>Easy Upload</h6>
        </div>
        <div class="feature_box">
            <img src="image/global_reach.jpg" class="fea_logo" alt="">
            <h6>Global Reach</h6>
        </div>
        <div class="feature_box">
            <img src="image/seller_dashboard.jpg" class="fea_logo" alt="">
            <h6>Seller Dashboard</h6>
        </div>
        <div class="feature_box">
            <img src="image/secure_payments.jpg" class="fea_logo" alt="">
            <h6>Secure Payments</h6>
        </div>
        <div class="feature_box">
            <img src="image/everytime.jpg" class="fea_logo" alt="">
            <h6>24/7 Support</h6>
        </div>
    </section>

    <section id="upload-section" class="section-p1">
        <h2>Upload New Artwork</h2>
        <form action="upload_artwork.php" method="post" enctype="multipart/form-data" class="upload-form">
            <label for="artist">
                <span>First Name :</span>
                <input type="text" name="artist" placeholder="Artist Name" required autofocus />
            </label><br>
            <input type="hidden" name="artist_id" value="<?php echo $_SESSION['user_id']; ?>">
            <br>
            <label for="title">
                <span>ArtWork Title :</span>
                <input type="text" name="title" placeholder="Title" required />
            </label><br>
            <label for="description">
                <span>Description :</span>
                <textarea name="description" placeholder="Description" required></textarea>
            </label><br>
            <label for="price">
                <span>ArtWork Price :</span>
                <input type="number" name="price" placeholder="Price ($)" step="0.01" required />
            </label><br>
            <label for="art_image">
                <span>ArtWork Image :</span>
                <input type="file" name="art_image" accept="image/*" required />
            </label><br>
            <input type="submit" value="Upload ArtWork">
        </form>
    </section>

    <section id="news" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign up for newsletters</h4>
            <p>Get email updates on buyer activity, artwork performance, and upcoming seller promotions.</p>
        </div>
        <div class="from">
            <input type="text" placeholder="Your Email Address">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <h4>Contact</h4>
            <p><strong>Phone No:</strong> this is my contact</p>
            <div class="follow">
                <h4>Follow Us</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-pinterest-p"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
        </div>

        <div>
            <img src="image/aplogo.jpg" class="logo1" alt="">
        </div>

        <div class="col">
            <h4>About</h4>
            <a href="#">About Us</a>
            <a href="#">Delivery Info.</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms and Conditions</a>
            <a href="#">Contact Us</a>
        </div>

        <div class="copywrite">
            <p>Create By Art Paradise @2023 | All Right Reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>