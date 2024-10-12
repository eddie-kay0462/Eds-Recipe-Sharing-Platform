// Get elements
const updateButtons = document.querySelectorAll('.update-btn');
const updateForm = document.querySelector('.update-form');
const overlay = document.querySelector('.overlay');
const updateSubmit = document.getElementById('update-submit');
const cancelUpdate = document.getElementById('cancel-update');
const deleteButtons = document.querySelectorAll('.delete-btn');

// Show the update form on button click
updateButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        const row = event.target.closest('tr');  // Get the row

        // Get row data
        const userId = row.children[0].textContent;  // Get the user ID 
        const userName = row.children[1].textContent;  // Get the user name
        const userEmail = row.children[2].textContent;      // Get the user email


        // Show form and overlay
        updateForm.style.display = 'block';
        overlay.style.display = 'block';
        
        // Save row index to update later
        updateForm.dataset.rowIndex = Array.from(row.parentElement.children).indexOf(row);  // Save the row index
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
// Delete row on button click
deleteButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        const row = event.target.closest('tr');  // Get the row
        const userName = row.children[1].textContent;  // Get the user name
        const confirmDelete = confirm(`Are you sure you want to delete ${userName}?`);

        if (!confirmDelete) return;  // If user cancels, do nothing
        row.remove(); // Remove the row
    });
});
// Email validation function
function validateEmail(email) {
    const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return re.test(String(email).toLowerCase());
}