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
        <form id="addRecipeForm" method="POST" class="needs-validation" novalidate>
            <!-- Food Details Section -->
            <div class="card mb-4 shadow">
                <div class="card-header bg-primary text-white">
                    Food Details
                </div>
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
                                <option value="appetizer">Appetizer</option>
                                <option value="main_course">Main Course</option>
                                <option value="dessert">Dessert</option>
                                <option value="beverage">Beverage</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="isHealthy" class="form-label">Is Healthy?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="isHealthy" name="is_healthy" value="1">
                                <label class="form-check-label" for="isHealthy">
                                    Healthy Option
                                </label>
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
                            <input type="url" class="form-control" id="foodImageURL" name="image_url" placeholder="Enter image URL" required>
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
                <div class="card-header bg-primary text-white">
                    Ingredients
                </div>
                <div class="card-body" id="ingredientsContainer">
                    <div class="ingredient-row row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Ingredient Name</label>
                            <input type="text" class="form-control" name="ingredient_name[]" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="ingredient_quantity[]" min="0" step="0.1" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Alergen info</label>
                            <input type="number" class="form-control" name="alergen_info[]" min="0" step="0.1" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Nutritional value</label>
                            <input type="number" class="form-control" name="nutritional_value[]" min="0" step="0.1" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Shelf life</label>
                            <input type="number" class="form-control" name="shelf_life[]" min="0" step="0.1" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Unit</label>
                            <select class="form-select" name="ingredient_unit[]">
                                <option value="g">Grams</option>
                                <option value="kg">Kilograms</option>
                                <option value="ml">Milliliters</option>
                                <option value="l">Liters</option>
                                <option value="cup">Cups</option>
                                <option value="tbsp">Tablespoons</option>
                                <option value="tsp">Teaspoons</option>
                                <option value="piece">Pieces</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Optional</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="ingredient_optional[]" value="1">
                                <label class="form-check-label">Optional Ingredient</label>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-ingredient" style="display:none;">Remove</button>
                        </div>
                    </div>
                    <button type="button" id="addIngredientBtn" class="btn btn-secondary mt-2">Add Another Ingredient</button>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100">Add Recipe</button>
        </form>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Dynamically add ingredients
        document.getElementById('addIngredientBtn').addEventListener('click', function() {
            const container = document.getElementById('ingredientsContainer');
            const newRow = container.querySelector('.ingredient-row').cloneNode(true);

            newRow.querySelectorAll('input').forEach(input => {
                input.value = '';
                input.checked = false;
            });

            newRow.querySelector('.remove-ingredient').style.display = 'block';
            newRow.querySelector('.remove-ingredient').addEventListener('click', function() {
                container.removeChild(newRow);
            });

            container.appendChild(newRow);
        });

        // Form validation
        (function() {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })();
    </script>
</body>

</html>