<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Sign Up - Sign In</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <link rel="stylesheet" href="signin_signup.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
</head>

<body>
  <div class="main">
    <!-- Sign Up Form -->
    <div class="container a-container" id="a-container">
      <form class="form" id="a-form" method="POST" action="signup.php">
        <h2 class="form_title title">Create Account</h2>
        <input class="form__input" type="text" placeholder="Username" name="user_name" required>
        <input class="form__input" type="password" placeholder="Password" name="password" required>
        <select class="form__input" name="role" required>
          <option value="">Select Role</option>
          <option value="admin">Admin</option>
          <option value="seller">Seller</option>
          <option value="buyer">Buyer</option>
        </select>
        <button class="form__button button" type="submit" name="signup">SIGN UP</button>
      </form>
    </div>

    <!-- Sign In Form -->
    <div class="container b-container" id="b-container">
      <form class="form" id="b-form" method="POST" action="signin.php">
        <h2 class="form_title title">Sign in to Website</h2>
        <input class="form__input" type="text" placeholder="Username" name="user_name" required>
        <input class="form__input" type="password" placeholder="Password" name="password" required>
        <a class="form__link" href="#">Forgot your password?</a>
        <button class="form__button button" type="submit" name="signin">SIGN IN</button>
      </form>
    </div>

    <!-- Switch Animation Panels -->
    <div class="switch" id="switch-cnt">
      <div class="switch__circle"></div>
      <div class="switch__circle switch__circle--t"></div>

      <div class="switch__container" id="switch-c1">
        <h2 class="switch__title title">Welcome Back!</h2>
        <p class="switch__description description">To keep connected with us please login with your personal info</p>
        <button class="switch__button button switch-btn">GO TO SIGN IN</button>
      </div>

      <div class="switch__container is-hidden" id="switch-c2">
        <h2 class="switch__title title">Hello Friend!</h2>
        <p class="switch__description description">Enter your personal details and start your journey with us</p>
        <button class="switch__button button switch-btn">GO TO SIGN UP</button>
      </div>
    </div>
  </div>

  <script src="signin_signup.js"></script>
</body>

</html>
