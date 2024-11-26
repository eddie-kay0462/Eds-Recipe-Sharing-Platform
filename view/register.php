<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/signup.css">
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

        .signup {
            position: relative;
            /* Ensure positioning context for absolute icon */
        }
    </style>
</head>

<body>

    <!-- signup form -->
    <div class="signup">
        <a href="../index.php" class="home-link" title="Go to Home">
            <i class="fas fa-home"></i>
            <span>Back to Home</span>
        </a>
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
            <!-- <a type="submit" href="" name="signup" class="button">Sign Up</a> -->
            <a href="login.php" class="login">Already have an account?</a>
        </form>

    </div>

    <script src="../assets/js/signup.js"></script>
</body>

</html>