<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//Session start
session_start();

// Include the database connection file
include('../../db/config.php');

// Check if user is logged in and has admin privileges
if (!isset($_SESSION['user']) || $_SESSION['role'] != 1) {
    header('Location: ../../index.php');
    exit();
}
//get all users 
$stmt = $conn->prepare('SELECT * FROM users');
$stmt->execute();
$users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
// select all recipes
$stmt = $conn->prepare('SELECT * FROM foods');
$stmt->execute();
$foods = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/recipe_mgt.css">
    <title>Recipe Management</title>
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
                <img src="../../assets/images/me.jpg" alt=""><br><br>
                <h2>Admin</h2>
            </center>
            <br>
            <a href="../../index.php"><span class="material-symbols-outlined">home</span><span>Home</span></a>
            <a href="dashboard.php"><span class="material-icons-outlined">dashboard</span><span>Dashboard</span></a>
            <a href="recipe_mgt.php"><span class="material-symbols-outlined">lunch_dining</span><span>Recipes</span></a>
            <a href="users.php"><span class="material-icons-outlined">people</span><span>Users</span></a>
            <a href="#"><span class="material-icons-outlined">poll</span><span>Reports</span></a>
            <a href="../../index.php"><span class="material-symbols-outlined">logout</span><span>Logout</span></a>

            <a href="../../index.php" class="Logout"><span>Logout</span></a>
        </div>

        <!-- main -->
        <main class="main-container">
            <!-- Table Listing All Recipes -->
            <h3>Recipe List</h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>AuthorID</th>
                            <th>AuthorName</th>
                            <th>Date Created</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($foods as $food) { ?>
                            <tr>
                                <td><?php echo $food['food_id']; ?></td>
                                <td><?php echo $food['name']; ?></td>
                                <td><?php echo $food['created_by']; ?></td>
                                <!-- get thefood author first name and last name from the users table -->
                                <td>
                                    <?php
                                    foreach ($users as $user) {
                                        if ($user['user_id'] == $food['created_by']) {
                                            echo $user['fname'] . ' ' . $user['lname'];
                                        }
                                    }
                                    ?>
                                </td>

                                <td><?php echo $food['created_at']; ?></td>
                                <td>
                                    <button class="view-recipe read-btn" data-id="<?php echo $food['food_id']; ?>">View</button>
                                    <button class="edit-recipe update-btn" data-id="<?php echo $food['food_id']; ?>">Edit</button>
                                    <button class="delete-recipe delete-btn" data-id="<?php echo $food['food_id']; ?>">Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <button id="add-recipe"><a href="../../utils/manage_recipes.php">ADD a new Recipe</a></button>
        </main>



        <!-- modal for viewing recipe details, with sections food_id, name, origin, type, is_healthy, instructions, description, prepation_time, cooking_time, serving_size, calories_per_serving, image_url, created_by, created_at -->
        <div class="modal" id="recipe-modal">
            <div class="modal-content">
                <!-- <span class="close">&times;</span> -->
                <h2>Recipe Details</h2>
                <div class="recipe-details">
                </div>
                <button id="close">Close</button>
            </div>
        </div>
    </div>
    <script src="../../assets/js/recipe_mgt.js"></script>
</body>

</html>