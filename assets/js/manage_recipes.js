// Dynamically add ingredients
document.getElementById('addIngredientBtn').addEventListener('click', function() {
    const container = document.getElementById('ingredientsContainer');
    const newRow = container.querySelector('.ingredient-row').cloneNode(true);
    newRow.querySelectorAll('input').forEach(input => input.value = '');
    newRow.querySelector('.remove-ingredient').addEventListener('click', function() {
        newRow.remove();
    });
    container.appendChild(newRow);
});

// Remove ingredient row
document.querySelectorAll('.remove-ingredient').forEach(button => {
    button.addEventListener('click', function() {
        this.closest('.ingredient-row').remove();
    });
});

// Form validation and submission
(function() {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                // If form is valid, submit it
                form.submit();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();