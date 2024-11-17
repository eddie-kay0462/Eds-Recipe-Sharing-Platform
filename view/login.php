<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <!-- login form -->
    <div class="login">
        <h2>Login</h2>
        <form class="login-form" action="../actions/login_user.php" method="post">
            <label for="email">Email</label><br>
            <input type="text" name="email" id="email" placeholder="Email" required><br><br>
            <div id="emailError" class="error"></div>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" placeholder="Password" required><br><br>
            <div id="passwordError" class="error"></div>
            <!-- <a href="" class="button">Login</a> -->
            <button type="submit" class="button">Login</button>
            <a href="register.php" class="signup">New User? Register here!</a>
        </form>
    </div>
    <script src="./assets/js/login.js"></script>
</body>

</html>