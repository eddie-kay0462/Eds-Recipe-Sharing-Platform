<?php
include '../db/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        //get and trim AND sanitize form data
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        //TRIM AND SANITIZE FORM DATA
        $email = trim($email);
        $password = trim($password);


        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['role'] = $user['role'];

                switch ($user['role']) {
                    case  1:
                        header('Location: ../view/admin/dashboard.php');
                        break;

                    case 2:
                        header('Location: ../view/explore_recipes.php');
                        break;
                    default:
                        header('Location: ../view/explore_recipes.php');
                        break;
                }
            }
        }

        header('Location: ../view/login.php?error=Invalid email or password');
    }
}
