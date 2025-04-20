<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Art - Buyer Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>

    <section id="header">
        <a href="#"><img src="image/aplogo.jpg" class="logo" alt=""></a>

        <div>
            <ul id="navbar">
                <li><a href="#">Home</a></li>
                <li><a href="#product1">Shop</a></li>
                <li><a href="#news">About</a></li>
                <li><a href="#news">Contact us</a></li>
                <li><a href="cart.html"><i class="fa-solid fa-cart-shopping"></i></a></li>
                <!-- Login and Signup buttons -->
                <li><a href="login.html" class="login-btn">Login</a></li>
                <li><a href="signup.html" class="signup-btn">Signup</a></li>
            </ul>
        </div>
    </section>

    <section id="hero">
        <a href="#"><img src="image/cover.jpg" class="cover" alt=""></a>
        <h4>One stop shop for artworks</h4>
        <h1>Art Paradise</h1>
        <p>Purpose of art is a mystery!</p>
        <button>Shop Now</button>
    </section>

    <section id="feature" class="section-p1">
        <div class="feature_box">
            <img src="image/free_shipping.jpg" class="fea_logo" alt="">
            <h6>Free Shipping</h6>
        </div>

        <div class="feature_box">
            <img src="image/onlineorder.jpg" class="fea_logo" alt="">
            <h6>Online Order</h6>
        </div>

        <div class="feature_box">
            <img src="image/moneysave.jpg" class="fea_logo" alt="">
            <h6>Save Money</h6>
        </div>

        <div class="feature_box">
            <img src="image/promotions.jpg" class="fea_logo" alt="">
            <h6>Promotions</h6>
        </div>

        <div class="feature_box">
            <img src="image/everytime.jpg" class="fea_logo" alt="">
            <h6>24/7 Support</h6>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Artists</h2>
        <p>These are some of the top selling Artists and their ArtWorks</p>
        <div class="container">
            <?php include 'fetch_artworks.php'; ?>
        </div>
    </section>

    <section id="news" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign up for newsletters</h4>
            <p>Get Email updates on new art pieces and price updates. Also applicable for promotions.</p>
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
