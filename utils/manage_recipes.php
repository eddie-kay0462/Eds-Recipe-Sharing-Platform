<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f6f8f9 0%, #e5ebee 100%);
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            background: white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(45deg, #3b82f6, #2563eb);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .input-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .input-group input,
        .input-group select,
        .input-group textarea {
            border: 1px solid #d1d5db;
            transition: all 0.3s ease;
        }

        .input-group input:focus,
        .input-group select:focus,
        .input-group textarea:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            outline: none;
        }

        .btn-primary {
            background: linear-gradient(45deg, #3b82f6, #2563eb);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .ingredient-row:nth-child(even) {
            background-color: #f9fafb;
        }

        .ingredient-row:hover {
            background-color: #f3f4f6;
            transition: background-color 0.3s ease;
        }

        @media (max-width: 768px) {
            .form-container {
                margin: 0 10px;
                padding: 15px;
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="container mx-auto">
        <div class="form-container max-w-4xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden">

            <div class="form-header">
                <h1 class="text-3xl font-bold text-white">Recipe Management</h1>
            </div>

            <form class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Recipe Details Column -->
                    <div class="space-y-4">
                        <div class="input-group">
                            <label class="block text-gray-700 font-semibold mb-2" for="name">Food Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 rounded-lg border focus:border-blue-500" placeholder="Enter recipe name" required>
                        </div>

                        <div class="input-group">
                            <label class="block text-gray-700 font-semibold mb-2" for="origin">Origin</label>
                            <input type="text" id="origin" name="origin" class="w-full px-4 py-2 rounded-lg border" placeholder="Recipe origin">
                        </div>

                        <div class="input-group">
                            <label class="block text-gray-700 font-semibold mb-2" for="type">Food Type</label>
                            <select id="type" name="type" class="w-full px-4 py-2 rounded-lg border">
                                <option value="">Select Food Type</option>
                                <option value="appetizer">Appetizer</option>
                                <option value="main-course">Main Course</option>
                                <option value="dessert">Dessert</option>
                                <option value="beverage">Beverage</option>
                            </select>
                        </div>

                        <div class="input-group flex items-center">
                            <input type="checkbox" id="is_healthy" name="is_healthy" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="is_healthy" class="ml-2 text-gray-700 font-semibold">Is Healthy?</label>
                        </div>
                    </div>

                    <!-- Cooking Details Column -->
                    <div class="space-y-4">
                        <div class="input-group">
                            <label class="block text-gray-700 font-semibold mb-2" for="preparation_time">Preparation Time (mins)</label>
                            <input type="number" id="preparation_time" name="preparation_time" class="w-full px-4 py-2 rounded-lg border" placeholder="Preparation time">
                        </div>

                        <div class="input-group">
                            <label class="block text-gray-700 font-semibold mb-2" for="cooking_time">Cooking Time (mins)</label>
                            <input type="number" id="cooking_time" name="cooking_time" class="w-full px-4 py-2 rounded-lg border" placeholder="Cooking time">
                        </div>

                        <div class="input-group">
                            <label class="block text-gray-700 font-semibold mb-2" for="calories_per_serving">Calories per Serving</label>
                            <input type="number" id="calories_per_serving" name="calories_per_serving" class="w-full px-4 py-2 rounded-lg border" placeholder="Calories">
                        </div>
                    </div>
                </div>

                <!-- Description and Instructions -->
                <div class="grid grid-cols-1 gap-6">
                    <div class="input-group">
                        <label class="block text-gray-700 font-semibold mb-2" for="description">Food Description</label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 rounded-lg border" placeholder="Describe your recipe..."></textarea>
                    </div>

                    <div class="input-group">
                        <label class="block text-gray-700 font-semibold mb-2" for="instructions">Cooking Instructions</label>
                        <textarea id="instructions" name="instructions" rows="4" class="w-full px-4 py-2 rounded-lg border" placeholder="Step-by-step cooking instructions..."></textarea>
                    </div>
                </div>

                <!-- Recipe Ingredients Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Recipe Ingredients</h2>

                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
                        <div class="input-group">
                            <label class="block text-gray-700 font-semibold mb-2" for="ingredient">Ingredient Name</label>
                            <input type="text" id="ingredient" name="ingredient" class="w-full px-4 py-2 rounded-lg border" placeholder="Enter ingredient name" required>
                        </div>

                        <div class="input-group">
                            <label class="block text-gray-700 font-semibold mb-2" for="quantity">Quantity</label>
                            <input type="number" id="quantity" name="quantity" class="w-full px-4 py-2 rounded-lg border" placeholder="Enter quantity" required>
                        </div>

                        <div class="input-group">
                            <label class="block text-gray-700 font-semibold mb-2" for="unit">Unit</label>
                            <input type="text" id="unit" name="unit" class="w-full px-4 py-2 rounded-lg border" placeholder="Enter unit (e.g., cups, grams)" required>
                        </div>

                        <div class="input-group">
                            <label class="block text-gray-700 font-semibold mb-2" for="nutritional_value">Nutritional Value</label>
                            <input type="text" id="nutritional_value" name="nutritional_value" class="w-full px-4 py-2 rounded-lg border" placeholder="Nutritional information (e.g., 200 kcal)">
                        </div>

                        <div class="input-group">
                            <label class="block text-gray-700 font-semibold mb-2" for="allergen_info">Allergen Info</label>
                            <input type="text" id="allergen_info" name="allergen_info" class="w-full px-4 py-2 rounded-lg border" placeholder="List allergens (e.g., nuts, gluten)">
                        </div>

                        <div class="input-group">
                            <label class="block text-gray-700 font-semibold mb-2" for="shelf_life">Shelf Life</label>
                            <input type="text" id="shelf_life" name="shelf_life" class="w-full px-4 py-2 rounded-lg border" placeholder="Shelf life (e.g., 3 days)">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" class="btn-primary text-white px-6 py-2 rounded-full">Add Ingredient</button>
                    </div>

                    <!-- Ingredients List (Dynamic) -->
                    <div id="ingredient-list" class="mt-4"></div>
                </div>

                <div class="flex justify-center mt-6">
                    <button type="submit" class="btn-primary text-white px-6 py-3 rounded-full">Save Recipe</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        // JavaScript to handle dynamic ingredient rows
        document.querySelector('.btn-primary').addEventListener('click', function() {
            const ingredientName = document.getElementById('ingredient').value;
            const quantity = document.getElementById('quantity').value;
            const unit = document.getElementById('unit').value;
            const nutritionalValue = document.getElementById('nutritional_value').value;
            const allergenInfo = document.getElementById('allergen_info').value;
            const shelfLife = document.getElementById('shelf_life').value;

            if (ingredientName && quantity && unit) {
                const ingredientList = document.getElementById('ingredient-list');

                const ingredientRow = document.createElement('div');
                ingredientRow.classList.add('ingredient-row', 'p-4', 'flex', 'justify-between', 'items-center', 'rounded-lg', 'border-b');

                ingredientRow.innerHTML = `
                    <span class="font-semibold">${ingredientName}</span> |
                    <span>${quantity} ${unit}</span> |
                    <span>${nutritionalValue ? nutritionalValue : 'N/A'}</span> |
                    <span>${allergenInfo ? allergenInfo : 'None'}</span> |
                    <span>${shelfLife ? shelfLife : 'N/A'}</span>
                `;
                ingredientList.appendChild(ingredientRow);

                // Clear input fields
                document.getElementById('ingredient').value = '';
                document.getElementById('quantity').value = '';
                document.getElementById('unit').value = '';
                document.getElementById('nutritional_value').value = '';
                document.getElementById('allergen_info').value = '';
                document.getElementById('shelf_life').value = '';
            }
        });
    </script>
</body>

</html>