<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require '../../db/config.php';

// Check if user is logged in and has admin privileges
if (!isset($_SESSION['user']) || $_SESSION['role'] != 1) {
    header('Location: ../../index.php');
    exit();
}

//count total number of users
$user_stmt = $conn->prepare('SELECT count(*) as total_users FROM users');
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$total_users = $user_result->fetch_assoc()['total_users'];

//count total number of recipes
$recipe_stmt = $conn->prepare('SELECT count(*) as total_recipes FROM recipes');
$recipe_stmt->execute();
$recipe_result = $recipe_stmt->get_result();
$total_recipes = $recipe_result->fetch_assoc()['total_recipes'];  // fetch the total number of recipes

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">

    <title>Dashboard</title>
</head>

<body>

    <div class="grid-container">
        <input type="checkbox" id="menu">
        <nav>
            <label for="">R3seaPea</label>
            <ul>
                <li><a href="../../index.php">Home</a></li>
            </ul>

            <label for="menu" class="menu-bar"><i class="fa fa-bars"></i></label>
        </nav>
        <div class="side-menu">
            <center>
                <img src="../../assets/images/me.jpg" alt="">
                <h2>Admin</h2>
            </center>
            <a href="../../index.php"><span class="material-symbols-outlined">home</span><span>Home</span></a>
            <a href="dashboard.php"><span class="material-icons-outlined">dashboard</span><span>Dashboard</span></a>
            <a href="recipe_mgt.php"><span class="material-symbols-outlined">lunch_dining</span><span>Recipes</span></a>
            <a href="users.php"><span class="material-icons-outlined">people</span><span>Users</span></a>
            <a href="#"><span class="material-icons-outlined">poll</span><span>Reports</span></a>
            <a href="../../index.php"><span class="material-symbols-outlined">logout</span><span>Logout</span></a>
        </div>

        <!-- main -->
        <main class="main-container">
            <div class="title">
                <h1>Dashboard</h1>
            </div>
            <div class="major-cards">
                <div class="card">
                    <div class="card-inner-item">
                        <h3>TOTAL USERS</h3>
                        <span class="material-icons-outlined">people</span>
                    </div>
                    <h1><?php echo $total_users; ?></h1>
                </div>

                <div class="card">
                    <div class="card-inner-item">
                        <h3>TOTAL RECIPES</h3>
                        <span class="material-icons-outlined">lunch_dining</span>
                    </div>
                    <h1><?php echo $total_recipes; ?></h1>
                </div>
            </div>
        </main>

    </div>


</body>

</html>