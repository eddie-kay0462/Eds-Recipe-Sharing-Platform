<?php
// Start session
session_start();
// Include database connection
include '../db/config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the user from the session
$user = $_SESSION['user'];

// Get the user id from user
$user_id = $user['user_id'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Begin a transaction
    $conn->begin_transaction();

    try {
        // Get and trim AND sanitize form data
        $food_name = filter_input(INPUT_POST, 'food_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $food_origin = filter_input(INPUT_POST, 'food_origin', FILTER_SANITIZE_SPECIAL_CHARS);
        $food_type = filter_input(INPUT_POST, 'food_type', FILTER_SANITIZE_SPECIAL_CHARS);
        $is_healthy = filter_input(INPUT_POST, 'is_healthy', FILTER_SANITIZE_NUMBER_INT);
        $preparation_time = filter_input(INPUT_POST, 'preparation_time', FILTER_SANITIZE_NUMBER_INT);
        $cooking_time = filter_input(INPUT_POST, 'cooking_time', FILTER_SANITIZE_NUMBER_INT);
        $serving_size = filter_input(INPUT_POST, 'serving_size', FILTER_SANITIZE_NUMBER_INT);
        $calories_per_serving = filter_input(INPUT_POST, 'calories_per_serving', FILTER_SANITIZE_NUMBER_INT);
        $image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_URL);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
        $instructions = filter_input(INPUT_POST, 'instructions', FILTER_SANITIZE_SPECIAL_CHARS);
        $created_by = $user_id;

        // Get the ingredients
        $ingredient_names = $_POST['ingredient_name'];
        $ingredient_quantities = $_POST['ingredient_quantity'];
        $alergen_infos = $_POST['alergen_info'];
        $nutritional_values = $_POST['nutritional_value'];
        $shelf_lifes = $_POST['shelf_life'];
        $ingredient_optionals = isset($_POST['ingredient_optional']) ? $_POST['ingredient_optional'] : [];

        // Prepare and execute the food insert
        $stmt_food = $conn->prepare("INSERT INTO foods (name, origin, type, is_healthy, instructions, description, preparation_time, cooking_time, serving_size, calories_per_serving, image_url, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_food->bind_param("ssssssiiiiii", $food_name, $food_origin, $food_type, $is_healthy, $instructions, $description, $preparation_time, $cooking_time, $serving_size, $calories_per_serving, $image_url, $user_id);
        $stmt_food->execute();
        $food_id = $conn->insert_id;

        // Prepare statements for ingredients and recipes
        $stmt_ingredient = $conn->prepare("INSERT INTO ingredients (name, origin, nutritional_value, allergen_info, shelf_life) VALUES (?, ?, ?, ?, ?)");
        $stmt_recipe = $conn->prepare("INSERT INTO recipes (food_id, ingredient_id, quantity,optional) VALUES (?, ?, ?, ?)");

        // Loop through the ingredients
        for ($i = 0; $i < count($ingredient_names); $i++) {
            // Insert ingredient
            $stmt_ingredient->bind_param(
                "sssss",
                $ingredient_names[$i],
                $food_origin,
                $nutritional_values[$i],
                $alergen_infos[$i],
                $shelf_lifes[$i]
            );
            $stmt_ingredient->execute();
            $ingredient_id = $conn->insert_id;

            // Insert recipe connection
            $is_optional = in_array($i, $ingredient_optionals) ? 1 : 0;
            $stmt_recipe->bind_param(
                "iidi",
                $food_id,
                $ingredient_id,
                $ingredient_quantities[$i],
                $is_optional
            );
            $stmt_recipe->execute();
        }

        // Commit the transaction
        $conn->commit();

        // echo some javascript to say the recipe was added successfully and redirect to manage_recipes.php
        echo "<script>alert('Recipe added successfully.'); window.location.href = 'manage_recipes.php';</script>";
        exit();
    } catch (Exception $e) {
        // Rollback the transaction
        $conn->rollback();
        echo "<script>alert('An error occurred while adding the recipe. Please try again later.');</script>";
        // Log the error
        error_log($e->getMessage());
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Recipe</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center text-primary">Add New Recipe</h2>
        <form id="addRecipeForm" method="POST" class="needs-validation" action="manage_recipes.php" novalidate>
            <!-- Food Details Section -->
            <div class="card mb-4 shadow">
                <div class="card-header bg-primary text-white">Food Details</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="foodName" class="form-label">Food Name</label>
                            <input type="text" class="form-control" id="foodName" name="food_name" required>
                            <div class="invalid-feedback">Please enter a food name.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="foodOrigin" class="form-label">Origin</label>
                            <input type="text" class="form-control" id="foodOrigin" name="food_origin">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="foodType" class="form-label">Food Type</label>
                            <select class="form-select" id="foodType" name="food_type">
                                <option value="">Select Food Type</option>
                                <option value="breakfast">breakfast</option>
                                <option value="lunch">lunch</option>
                                <option value="dinner">dinner</option>
                                <option value="snack">snack</option>
                                <option value="dessert">dessert</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="isHealthy" class="form-label">Is Healthy?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="isHealthy" name="is_healthy" value="1">
                                <label class="form-check-label" for="isHealthy">Healthy Option</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="prepTime" class="form-label">Preparation Time (mins)</label>
                            <input type="number" class="form-control" id="prepTime" name="preparation_time" min="0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cookTime" class="form-label">Cooking Time (mins)</label>
                            <input type="number" class="form-control" id="cookTime" name="cooking_time" min="0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="servingSize" class="form-label">Serving Size</label>
                            <input type="number" class="form-control" id="servingSize" name="serving_size" min="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="caloriesPerServing" class="form-label">Calories per Serving</label>
                            <input type="number" class="form-control" id="caloriesPerServing" name="calories_per_serving" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="foodImageURL" class="form-label">Food Image URL</label>
                            <input type="url" class="form-control" id="foodImageURL" name="image_url" required>
                            <div class="invalid-feedback">Please enter a valid image URL.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="foodDescription" class="form-label">Food Description</label>
                        <textarea class="form-control" id="foodDescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foodInstructions" class="form-label">Cooking Instructions</label>
                        <textarea class="form-control" id="foodInstructions" name="instructions" rows="4" required></textarea>
                    </div>
                </div>
            </div>

            <!-- Ingredients Section -->
            <div class="card mb-4 shadow">
                <div class="card-header bg-primary text-white">Ingredients</div>
                <div class="card-body" id="ingredientsContainer">
                    <div class="ingredient-row row mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Ingredient Name</label>
                            <input type="text" class="form-control" name="ingredient_name[]" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="ingredient_quantity[]" min="0" step="0.1" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Allergen Info</label>
                            <input type="text" class="form-control" name="alergen_info[]" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Nutritional Value</label>
                            <input type="text" class="form-control" name="nutritional_value[]" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Shelf Life</label>
                            <input type="text" class="form-control" name="shelf_life[]" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Optional</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="ingredient_optional[]" value="1">
                                <label class="form-check-label">Optional Ingredient</label>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-ingredient">Remove</button>
                        </div>
                    </div>
                </div>
                <button type="button" id="addIngredientBtn" class="btn btn-secondary mt-2">Add Another Ingredient</button>
            </div>

            <button type="submit" class="btn btn-success w-100" id="submitRecipe">Add Recipe</button>
        </form>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/manage_recipes.js"></script>
</body>

</html>