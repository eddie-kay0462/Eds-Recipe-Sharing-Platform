<?php
include '../db/config2.php';

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
                header('Location: ../view/login.php?error=Invalid email or password');
                exit;
            }
        } else {
            // Redirect back with an error message for invalid email
            header('Location: ../view/login.php?error=Invalid email or password');
            exit;
        }
    }
}
