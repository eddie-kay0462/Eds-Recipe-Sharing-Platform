<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R3seaPea</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="/styles/recipefeed.css">
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo"><a href="#">R3seaPea</a></div>
            <ul class="links">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="./view/login.php" class="login">Login</a></li>
                <li><a href="./view/register.php" class="signup">SignUp</a></li>
            </ul>
            <a href="./view/login.php" class="action_btn">Get Started</a>
            <div class="toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="dropdown_menu">
            <li><a href="#">Home</a></li>
            <li><a href="./view/login.php">Login</a></li>
            <li><a href="./view/register.php">SignUp</a></li>
            <li><a href="#" id="contact">Contact</a></li>
            <li><a href="./view/login.php" class="action_btn">Get Started</a></li>
        </div>
    </header>
    <div class="content">
        <h1>Welcome to <i>R3seaPea!!!</i></h1>
        <p>Welcome to the ultimate hub for food lovers!!!! Discover, share, and create delicious recipes from around the world. Let's cook up something amazing together!</p>
        <a href="./view/login.php">Get Started</a>
    </div>

    <script>
        const toggleBtn = document.querySelector('.toggle_btn');
        const toggleBtnIcon = document.querySelector('.toggle_btn i');
        const dropDownMenu = document.querySelector('.dropdown_menu');
        toggleBtn.onclick = function() {
            dropDownMenu.classList.toggle('open');
            const isOpen = dropDownMenu.classList.contains('open');
            toggleBtnIcon.classList = isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'
        }
    </script>
</body>

</html>