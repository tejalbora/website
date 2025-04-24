<?php
session_start();

// Optional: Only allow logged-in admins
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../signin_signup.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Art Paradise</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
</head>

<body>
    <section id="header">
        <a href="#"><img src="../image/aplogo.jpg" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="#">Dashboard</a></li>
                <li><a href="manage_artworks.php">Artworks</a></li>
                <li><a href="all.php">Users</a></li>
                <li><a href="#newsletter-send">NewsLetters</a></li>
                <li><a href="../logout.php" class="login-btn">Logout</a></li>
            </ul>
        </div>
    </section>

    <section id="hero">
        <a href="#"><img src="../image/cover.jpg" class="cover" alt=""></a>
        <h4>Welcome back, Admin!</h4>
        <h1>Admin Panel - Art Paradise</h1>
        <p>Manage artists, artworks, and buyers.</p>
        <button>Admin Controls</button>
    </section>

    <section id="feature" class="section-p1">
        <div class="feature_box">
            <img src="../image/seller_dashboard.jpg" class="fea_logo" alt="">
            <h6>Manage Sellers</h6>
        </div>
        <div class="feature_box">
            <img src="../image/global_reach.jpg" class="fea_logo" alt="">
            <h6>Monitor Sales</h6>
        </div>
        <div class="feature_box">
            <img src="../image/everytime.jpg" class="fea_logo" alt="">
            <h6>24/7 Moderation</h6>
        </div>
        <div class="feature_box">
            <img src="../image/secure_payments.jpg" class="fea_logo" alt="">
            <h6>Transaction Logs</h6>
        </div>
        <div class="feature_box">
            <img src="../image/upload.png" class="fea_logo" alt="">
            <h6>Artwork Approvals</h6>
        </div>

    </section>

    <section id="newsletter-send">
        <div class="left">
            <h4>Send Newsletter</h4>
            <p>Reach all registered users and sellers instantly with updates, offers, or important announcements.</p>

            <!-- Move "Send To" here -->
            <label for="audience">Send To:</label>
            <select name="audience" form="newsletterForm" required>
                <option value="">Select Audience</option>
                <option value="all">All Users</option>
                <option value="sellers">Sellers Only</option>
                <option value="buyers">Buyers Only</option>
            </select>
        </div>

        <!-- The rest of the form -->
        <form action="send_newsletter.php" method="post" id="newsletterForm" class="right">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" placeholder="Newsletter Subject" required>

            <label for="message">Message:</label>
            <textarea name="message" placeholder="Write your newsletter message here..." required></textarea>

            <input type="submit" value="Send Newsletter">
        </form>
    </section>

    <footer class="section-p1">
        <div class="col">
            <h4>Contact</h4>
            <p><strong>Admin Support:</strong> admin@artparadise.com</p>
        </div>

        <div>
            <img src="../image/aplogo.jpg" class="logo1" alt="">
        </div>

        <div class="col">
            <h4>Admin Info</h4>
            <a href="#">Admin Policy</a>
            <a href="#">Log History</a>
            <a href="#">Account Management</a>
        </div>

        <div class="copywrite">
            <p>Art Paradise Admin Panel @2023 | All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>