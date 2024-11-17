<?php
    include '../db/config.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);  // fetch the user details
                if (password_verify($password, $user['password'])) {  // verify the password
                    session_start();  // start a session to store the user details
                    $_SESSION['user'] = $user;  // store the user details in the session
                    header('Location: ../view/explore_recipes.php');  // redirect to the explore recipes page
                } else {
                    echo 'Invalid email or password';
                }
            } else {
                echo 'Invalid email or password';
            }
        }
    }
?>