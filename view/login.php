<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <!-- Optional: Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Additional CSS to style the home icon and text */
        .home-link {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .home-link:hover {
            color: #838A59;
            /* Change color on hover */
        }

        .home-link i {
            font-size: 1.7rem;
            margin-right: 10px;
            /* Space between icon and text */
        }

        .home-link span {
            font-size: 16px;
            font-weight: 500;
        }

        .login {
            position: relative;
            /* Ensure positioning context for absolute icon */
        }
    </style>
</head>

<body>
    <!-- login form -->
    <div class="login">
        <!-- Home Icon Link -->
        <a href="../index.php" class="home-link" title="Go to Home">
            <i class="fas fa-home"></i>
            <span>Back to Home</span>
        </a>

        <h2>Login</h2>

        <!-- Display error message if login fails and clear the message after 3 seconds -->
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <script>
                setTimeout(() => {
                    document.querySelector('.error').style.display = 'none';
                }, 2000);
            </script>
        <?php } ?>

        <form class="login-form" action="../actions/login_user.php" method="post">
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