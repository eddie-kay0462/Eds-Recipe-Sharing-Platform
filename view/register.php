<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/signup.css">
    <style>
        /* Navbar styles */
        .navbar {
            background-color: #fff;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .logo a {
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 16px;
            transition: color 0.3s ease;
            padding: 8px 15px;
            border-radius: 4px;
        }

        .nav-links a:hover {
            color: #838A59;
            background-color: rgba(131, 138, 89, 0.1);
        }

        .signup {
            position: relative;
            margin-top: 100px; /* Increased to account for fixed navbar */
            padding: 20px;
        }

        /* Remove the home-link styles since we have a proper navbar now */
    </style>
</head>

<body>
    <!-- Navigation bar -->
    <nav class="navbar">
        <div class="logo">
            <a href="../index.php">R3seaPea</a>
        </div>
        <div class="nav-links">
            <a href="../index.php">Home</a>
            <a href="explore_recipes.php">Explore</a>
            <a href="login.php">Login</a>
            <a href="register.php">Sign Up</a>
        </div>
    </nav>

    <!-- signup form -->
    <div class="signup">
        <h1>Sign Up</h1>
        <!-- Display error message if signup fails and clear the message after 3 seconds -->
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <script>
                setTimeout(() => {
                    document.querySelector('.error').style.display = 'none';
                }, 2000);
            </script>
        <?php } ?>
        <form id="signupForm" action="../actions/register_user.php" method="post">
            <label for="fname">First Name</label><br>
            <input type="text" name="fname" id="fname" placeholder="First Name"><br>
            <span id="fnameError" class="error"></span><br>

            <label for="lname">Last Name</label><br>
            <input type="text" name="lname" id="lname" placeholder="Last Name"><br>
            <span id="lnameError" class="error"></span><br>

            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" placeholder="Email"><br>
            <span id="emailError" class="error"></span><br>

            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" placeholder="Password"><br>
            <span id="passwordError" class="error"></span><br>

            <label for="confirmPassword">Confirm Password</label><br>
            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm password"><br>
            <span id="confirmPasswordError" class="error"></span><br>
            <input type="submit" class="button" name="register" value="Register" style="width:100%;">
            <a href="login.php" class="login">Already have an account?</a>
        </form>
    </div>

    <script src="../assets/js/signup.js"></script>
</body>

</html>