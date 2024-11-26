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
            <a href="index.html"><span class="material-symbols-outlined">home</span><span>Home</span></a>
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
                            <th>Author</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Chocolate Cake</td>
                            <td>John Doe</td>
                            <td>2024-09-01</td>
                            <td>
                                <button class="read-btn">VIEW MORE</button>
                                <button class="update-btn">Update</button>
                                <button class="delete-btn">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Spaghetti Bolognese</td>
                            <td>Jane Smith</td>
                            <td>2024-09-10</td>
                            <td>
                                <button class="read-btn">VIEW MORE</button>
                                <button class="update-btn">Update</button>
                                <button class="delete-btn">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button id="add-recipe">Add New Recipe</button>
        </main>

        <!-- recipe form for adding new recipe -->
        <div id="recipeModal" class="modalAddRecipe">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="recipeForm">
                    <label for="title">Recipe Title:</label>
                    <input type="text" id="title" name="title" required>
                    <p id="titleError" class="error"></p>

                    <label for="ingredients">Ingredients:</label>
                    <textarea id="ingredients" name="ingredients" required></textarea>
                    <p id="ingredientsError" class="error"></p>

                    <label for="origin">Origin:</label>
                    <input type="text" id="origin" name="origin">
                    <span id="originError" class="error"></p>

                        <label for="nutritionalValue">Nutritional Value:</label>
                        <textarea id="nutritionalValue" name="nutritionalValue"></textarea>
                        <p id="nutritionalValueError" class="error"></p>

                        <label for="allergenInfo">Allergen Information:</label>
                        <input type="text" id="allergenInfo" name="allergenInfo">
                        <p id="allergenInfoError" class="error"></p>

                        <label for="shelfLife">Shelf Life:</label>
                        <input type="text" id="shelfLife" name="shelfLife">
                        <p id="shelfLifeError" class="error"></p>

                        <label for="image">Recipe Image URL:</label>
                        <input type="url" id="image" name="image">
                        <p id="imageError" class="error"></p>

                        <label for="prepTime">Preparation Time (minutes):</label>
                        <input type="number" id="prepTime" name="prepTime" required>
                        <p id="prepTimeError" class="error"></p>

                        <label for="cookTime">Cooking Time (minutes):</label>
                        <input type="number" id="cookTime" name="cookTime" required>
                        <p id="cookTimeError" class="error"></p>

                        <label for="servingSize">Serving Size:</label>
                        <input type="text" id="servingSize" name="servingSize" required>
                        <p id="servingSizeError" class="error"></p>

                        <label for="description">Food Description:</label>
                        <textarea id="description" name="description" required></textarea>
                        <p id="descriptionError" class="error"></p>

                        <label for="calories">Calories per Serving:</label>
                        <input type="number" id="calories" name="calories">
                        <p id="caloriesError" class="error"></p>

                        <label for="foodOrigin">Food Origin:</label>
                        <input type="text" id="foodOrigin" name="foodOrigin">
                        <p id="foodOriginError" class="error"></p>

                        <label for="instructions">Instructions:</label>
                        <textarea id="instructions" name="instructions" required></textarea>
                        <p id="instructionsError" class="error"></p>

                        <button type="submit">Add Recipe</button>
                </form>
            </div>
        </div>
        <!-- Modal for viewing recipe details -->
        <div class="modal" id="recipe-modal">
            <h3>Recipe Details</h3>
            <p id="recipe-details"></p>
            <button id="close-recipe-modal">Close</button>
        </div>
    </div>
    <script src="../../assets/js/recipe_mgt.js"></script>
</body>

</html>