// Get elements
const updateButtons = document.querySelectorAll('.update-btn');
const updateForm = document.querySelector('.update-form');
const overlay = document.querySelector('.overlay');
const updateSubmit = document.getElementById('update-submit');
const cancelUpdate = document.getElementById('cancel-update');

// Show the update form on button click
updateButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        const row = event.target.closest('tr');
        
        const userId = row.children[0].textContent;
        const userName = row.children[1].textContent;
        const userEmail = row.children[2].textContent;

        // Populate form fields with existing data
        document.getElementById('update-id').value = userId;
        document.getElementById('update-name').value = userName;
        document.getElementById('update-email').value = userEmail;

        // Show form and overlay
        updateForm.style.display = 'block';
        overlay.style.display = 'block';

        // Save row index to update later
        updateForm.dataset.rowIndex = Array.from(row.parentElement.children).indexOf(row);
    });
});

// Update row data on submit
updateSubmit.addEventListener('click', () => {
    const rowIndex = updateForm.dataset.rowIndex;
    const rows = document.querySelectorAll('tbody tr');
    const row = rows[rowIndex];
    
    const newId = document.getElementById('update-id').value;
    const newName = document.getElementById('update-name').value;
    const newEmail = document.getElementById('update-email').value;

    // Simple validation
    if (newId === '' || newName === '' || !validateEmail(newEmail)) {
        alert('Please provide valid inputs');
        return;
    }

    // Update table row with new data
    row.children[0].textContent = newId;
    row.children[1].textContent = newName;
    row.children[2].textContent = newEmail;

    // Hide form and overlay
    updateForm.style.display = 'none';
    overlay.style.display = 'none';
});

// Hide form on cancel
cancelUpdate.addEventListener('click', () => {
    updateForm.style.display = 'none';
    overlay.style.display = 'none';
});

// Email validation function
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}