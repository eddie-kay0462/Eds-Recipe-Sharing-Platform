<?php
include '../db/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = $user;
                header('Location: ../view/explore_recipes.php');
                exit;
            } else {
                // Redirect back with an error message for invalid password
                header('Location: loggin.php?error=Invalid email or password');
                exit;
            }
        } else {
            // Redirect back with an error message for invalid email
            header('Location: loggin.php?error=Invalid email or password');
            exit;
        }
    }
}
?>






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
        <!-- Display error message if present -->
        <?php if (isset($_GET['error'])): ?>
            <div class="error-message" style="color: red; margin-bottom: 10px;">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        <form class="login-form" action="loggin.php" method="post">
            <label for="email">Email</label><br>
            <input type="text" name="email" id="email" placeholder="Email" required><br><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" placeholder="Password" required><br><br>
            <button type="submit" class="button">Login</button>
            <a href="register.php" class="signup">New User? Register here!</a>
        </form>
    </div>

    <script src="./assets/js/login.js"></script>
</body>

</html>