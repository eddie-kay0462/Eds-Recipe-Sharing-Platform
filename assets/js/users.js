// // Get elements
// const updateButtons = document.querySelectorAll('.update-btn');
// const deleteButtons = document.querySelectorAll('.delete-btn');
// const viewMoreButtons = document.querySelectorAll('.read-btn');
// const updateForm = document.querySelector('.update-form');
// const overlay = document.querySelector('.overlay');
// const updateSubmit = document.getElementById('update-submit');
// const cancelUpdate = document.getElementById('cancel-update');
// const userModal = document.getElementById('user-modal');
// const userDetails = document.getElementById('user-details');
// const closeModal = document.getElementById('close-modal');

// // Show the update form on button click
// updateButtons.forEach(button => {
//     button.addEventListener('click', (event) => {
//         const row = event.target.closest('tr');  // Get the row

//         // Get row data
//         const userId = row.children[0].textContent;  // Get the user ID 
//         const userName = row.children[1].textContent;  // Get the user name
//         const userEmail = row.children[2].textContent;      // Get the user email


//         // Show form and overlay
//         updateForm.style.display = 'block';
//         overlay.style.display = 'block';
        
//         // Save row index to update later
//         updateForm.dataset.rowIndex = Array.from(row.parentElement.children).indexOf(row);  // Save the row index
//     });
// });

// // Update row data on submit
// updateSubmit.addEventListener('click', () => {
//     const rowIndex = updateForm.dataset.rowIndex;
//     const rows = document.querySelectorAll('tbody tr');
//     const row = rows[rowIndex];
    
//     const newId = document.getElementById('update-id').value;
//     const newName = document.getElementById('update-name').value;
//     const newEmail = document.getElementById('update-email').value;

//     // Simple validation
//     if (newId === '' || newName === '' || !validateEmail(newEmail)) {
//         alert('Please provide valid inputs');
//         return;
//     }

//     // Update table row with new data
//     row.children[0].textContent = newId;
//     row.children[1].textContent = newName;
//     row.children[2].textContent = newEmail;

//     // Hide form and overlay
//     updateForm.style.display = 'none';
//     overlay.style.display = 'none';
// });

// // Hide form on cancel
// cancelUpdate.addEventListener('click', () => {
//     updateForm.style.display = 'none';
//     overlay.style.display = 'none';
// });
// // Delete row on button click
// deleteButtons.forEach(button => {
//     button.addEventListener('click', (event) => {
//         const row = event.target.closest('tr');  // Get the row
//         const userName = row.children[1].textContent;  // Get the user name
//         const confirmDelete = confirm(`Are you sure you want to delete the user with name ${userName}?`);
//         if (!confirmDelete) return;  // If user cancels, do nothing
//         row.remove(); // Remove the row
//     });
// });

// // View more details on button click
// viewMoreButtons.forEach(button => {
//     button.addEventListener('click', (event) => {
//         const row = event.target.closest('tr');  // Get the row
//         const userId = row.children[0].textContent;  // Get the user ID
//         const userName = row.children[1].textContent;  // Get the user name
//         const userEmail = row.children[2].textContent;  // Get the user email

//         // Show modal and overlay
//         userModal.style.display = 'block';
//         overlay.style.display = 'block';

//         // Show user details
//         userDetails.innerHTML = `
//             <p><strong>User ID:</strong> ${userId}</p><br>  
//             <p><strong>Name:</strong> ${userName}</p><br>
//             <p><strong>Email:</strong> ${userEmail}</p>
//         `;
//     });

// });


// // Close modal on button click
// closeModal.addEventListener('click', () => {
//     userModal.style.display = 'none';
//     overlay.style.display = 'none';
// });
// // Email validation function
// function validateEmail(email) {
//     const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
//     return re.test(String(email).toLowerCase());
// }


// Get elements
const updateButtons = document.querySelectorAll('.update-btn');
const deleteButtons = document.querySelectorAll('.delete-btn');
const viewMoreButtons = document.querySelectorAll('.read-btn');
const updateForm = document.querySelector('.update-form');
const overlay = document.querySelector('.overlay');
const updateSubmit = document.getElementById('update-submit');
const cancelUpdate = document.getElementById('cancel-update');
const userModal = document.getElementById('user-modal');
const userDetails = document.getElementById('user-details');
const closeModal = document.getElementById('close-modal');

// Email validation function
function validateEmail(email) {
    const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return re.test(String(email).toLowerCase());
}

// Show the update form on button click
updateButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        const userId = button.getAttribute('data-id');
        
        // Fetch user details via AJAX
        fetch(`../../utils/get_user_details.php?user_id=${userId}`)
            .then(response => response.json())
            .then(user => {
                // Populate update form
                document.getElementById('update-id').value = user.user_id;
                document.getElementById('update-name').value = `${user.fname} ${user.lname}`;
                document.getElementById('update-email').value = user.email;
                
                // Show form and overlay
                updateForm.style.display = 'block';
                overlay.style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching user details:', error);
                alert('Failed to fetch user detailssss');
            });
    });
});

// Update row data on submit
updateSubmit.addEventListener('click', () => {
    const userId = document.getElementById('update-id').value;
    const fullName = document.getElementById('update-name').value;
    const email = document.getElementById('update-email').value;

    // Validate inputs
    if (userId === '' || fullName === '' || !validateEmail(email)) {
        alert('Please provide valid inputs');
        return;
    }

    // Split full name into first and last name
    const [fname, ...lnameArray] = fullName.split(' ');
    const lname = lnameArray.join(' ');

    // Create FormData to send update request
    const formData = new FormData();
    formData.append('id', userId);
    formData.append('fname', fname);
    formData.append('lname', lname);
    formData.append('email', email);

    // Send update request
    fetch('../../utils/update_user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            // Reload the page to reflect changes
            location.reload();
        } else {
            alert('Failed to update user: ' + result.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the user');
    });

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
        const userId = button.getAttribute('data-id');
        const userName = button.closest('tr').children[1].textContent;
        
        const confirmDelete = confirm(`Are you sure you want to delete the user with name ${userName}?`);
        if (!confirmDelete) return;  // If user cancels, do nothing
        
        // Create a form to submit for deletion
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = ''; // Current page

        // Create hidden input for user ID
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.value = userId;

        // Create hidden input for delete action
        const deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.name = 'delete';
        deleteInput.value = 'true';

        // Append inputs to form and submit
        form.appendChild(idInput);
        form.appendChild(deleteInput);
        document.body.appendChild(form);
        form.submit();
    });
});

// View more details on button click
viewMoreButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        const userId = button.getAttribute('data-id');
        
        // Fetch user details via AJAX
        fetch(`../../utils/get_user_details.php?user_id=${userId}`)
            .then(response => response.json())
            .then(user => {
                // Show modal and overlay
                userModal.style.display = 'block';
                overlay.style.display = 'block';

                // Show user details
                userDetails.innerHTML = `
                    <p><strong>User ID:</strong> ${user.user_id}</p><br>  
                    <p><strong>Name:</strong> ${user.fname} ${user.lname}</p><br>
                    <p><strong>Email:</strong> ${user.email}</p><br>
                    <p><strong>Role:</strong> ${user.role}</p><br>
                `;
            })
            .catch(error => {
                console.error('Error fetching user details:', error);
                alert('Failed to fetch user detailss');
            });
    });
});

// Close modal on button click
closeModal.addEventListener('click', () => {
    userModal.style.display = 'none';
    overlay.style.display = 'none';
});