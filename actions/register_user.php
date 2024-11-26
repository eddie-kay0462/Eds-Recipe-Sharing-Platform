<?php
include '../db/config.php';

//check if form is submited
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
        //retrieve form data and sanitize
        $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_SPECIAL_CHARS);
        $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        //check if password and confirm password match
        if ($password != $confirmPassword) {
            echo 'Password and confirm password do not match';
            exit();
        }

        //check if email already exists
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        //if email exists, redirect back with an error message, ON THE SAME REGISTER PAGE
        if (mysqli_num_rows($result) > 0) {
            header('Location: ../view/register.php?error=Email already exists');
            exit();
        }

        //hash password
        $password = password_hash($password, PASSWORD_DEFAULT);

        //insert user into database
        $sql = "INSERT INTO users (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // echo 'User registered successfully';
            header('Location: ../view/explore_recipes.php');
        } else {
            echo 'Failed to register user';
        }
    }
}
