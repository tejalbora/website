<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

include '../../config/db.php'; // Should define $conn

// Fetch cart items for the logged-in user
$user_id = $_SESSION['user_id'];
$sql = "SELECT c.cart_id, a.art_id, a.artist, a.title, a.price, a.art 
        FROM Cart c
        JOIN ArtWork a ON c.art_id = a.art_id
        WHERE c.buyer_id = '$user_id'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Paradise</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
</head>

<body>

    <!-- Navbar -->
    <section id="header">
        <a href="#"><img src="../../image/aplogo.jpg" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="#">Home</a></li>
                <li><a href="#product1">Shop</a></li>
                <li><a href="#news">About</a></li>
                <li><a href="#news">Contact us</a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
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

    <!-- Page Header -->
    <section id="page-header" class="about-header">
        <h2>Your Cart</h2>
        <p>Review your cart and proceed to checkout</p>
    </section>

    <!-- Cart Section -->
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>SubTotal</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price = 0;
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $img = base64_encode($row['art']);
                        $subtotal = $row['price'];
                        $total_price += $subtotal;
                        echo "
                        <tr>
                            <td><a href='remove_from_cart.php?cart_id={$row['cart_id']}'><i class='far fa-times-circle'></i></a></td>
                            <td><img src='data:image/jpeg;base64,$img' alt='Artwork' width='70'></td>
                            <td>{$row['title']}</td>
                            <td>₹{$row['price']}</td>
                            <td>₹$subtotal</td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='5'>Your cart is empty.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- Cart Totals Section -->
    <section id="cart-add" class="section-p1">
        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>₹<?php echo $total_price; ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>₹<?php echo $total_price; ?></strong></td>
                </tr>
            </table>
            <?php if ($total_price > 0): ?>
                <button class="normal" onclick="makePayment(<?php echo $total_price; ?>)">Pay</button>
            <?php endif; ?>
        </div>
    </section>

    <!-- Razorpay Payment Script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
    function makePayment(amount) {
        var options = {
            "key": "rzp_test_TReMcQAljlSBJh",
            "amount": amount * 100,
            "currency": "INR",
            "name": "Art Paradise",
            "description": "Artwork Purchase",
            "handler": function (response) {
                // Redirect with payment details
                window.location.href = "payment_success.php?payment_id=" + response.razorpay_payment_id 
                                     + "&order_id=" + response.razorpay_order_id 
                                     + "&signature=" + response.razorpay_signature;
            },
            "prefill": {
                "name": "<?php echo htmlspecialchars($_SESSION['user_name']); ?>"
            },
            "theme": {
                "color": "#F37254"
            }
        };
        var rzp = new Razorpay(options);
        rzp.open();
    }
    </script>

    <!-- Footer -->
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
            <img src="../../image/aplogo.jpg" class="logo1" alt="">
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
            <p>Created By Art Paradise @2023 | All Rights Reserved.</p>
        </div>
    </footer>

</body>

</html>

<?php
$conn->close();
?>
