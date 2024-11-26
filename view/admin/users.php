<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require '../../db/config2.php';

// Check if user is logged in and has admin privileges
if (!isset($_SESSION['user']) || $_SESSION['role'] != 1) {
    header('Location: ../../index.php');
    exit();
}

// Fetch the current user's role
$stmt = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
$stmt->bind_param('i', $_SESSION['user']['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$current_user = $result->fetch_assoc();

// Only admin users can access this page
if ($current_user['role'] != 1) {
    // Access to dashboard is denied
    header('Location: ../../index.php');
    exit();
}

// fetch all users except the current user
$stmt = $conn->prepare('SELECT * FROM users WHERE user_id != ?');
$stmt->bind_param('i', $_SESSION['user']['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);

//if delete button is clicked
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare('DELETE FROM users WHERE user_id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    header('Location: users.php');
    exit();
}
// Close prepared statement and result set
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/users.css">
    <title>User Management</title>

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
            <a href="index.php"><span class="material-symbols-outlined">home</span><span>Home</span></a>
            <a href="dashboard.php"><span class="material-icons-outlined">dashboard</span><span>Dashboard</span></a>
            <a href="recipe_mgt.php"><span class="material-symbols-outlined">lunch_dining</span><span>Recipes</span></a>
            <a href="users.php"><span class="material-icons-outlined">people</span><span>Users</span></a>
            <a href="#"><span class="material-icons-outlined">poll</span><span>Reports</span></a>
            <a href="../../index.php"><span class="material-symbols-outlined">logout</span><span>Logout</span></a>
        </div>

        <!-- main -->
        <main class="main-container">
            <h2>User List</h2>
            <table class="table-container">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   <?php forEach($users as $user) { ?>
                        <tr>
                            <td><?php echo $user['user_id']; ?></td>
                            <!-- both first and lanstname togethe -->
                            <td><?php echo $user['fname'] . ' ' . $user['lname']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td>
                                <button class="read read-btn" data-id="<?php echo $user['user_id']; ?>">View</button>
                                <button class="update update-btn" data-id="<?php echo $user['user_id']; ?>">Update</button>
                                <button class="delete delete-btn" data-id="<?php echo $user['user_id']; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
        <!-- Update Form (Hidden) -->
        <div class="overlay"></div>
        <div class="update-form">
            <h3>Update User</h3>
            <input type="text" id="update-id" placeholder="Enter ID" required>
            <input type="text" id="update-name" placeholder="Enter Name" required>
            <input type="email" id="update-email" placeholder="Enter Email" required>
            <button id="update-submit">Update</button>
            <button id="cancel-update">Cancel</button>
        </div>

        <!-- Modal for viewing user details -->
        <div class="modal" id="user-modal">
            <h3>User Details</h3>
            <p id="user-details"></p>
            <button id="close-modal">Close</button>
        </div>
    </div>
    <script src="../../assets/js/users.js"></script>
</body>

</html>