<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/css/signup.css">
</head>
<body>
    <!-- signup form -->
    <!-- signup form -->
    <div class="signup">
        <h1>Sign Up</h1>
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