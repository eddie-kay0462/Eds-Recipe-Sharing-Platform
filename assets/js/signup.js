document.addEventListener('DOMContentLoaded', function () {
    const signupForm = document.getElementById('signupForm');
    
    signupForm.addEventListener('submit', function (e) {
        e.preventDefault();  // Prevent the form from submitting to validate first

        // Reset previous error messages
        document.querySelectorAll('.error').forEach(el => el.textContent = '');
        
        let isValid = true;

        // Validate First Name
        const fname = document.getElementById('fname');
        if (fname.value.trim() === '') {
            document.getElementById('fnameError').textContent = 'First name is required';
            isValid = false;
        }

        // Validate Last Name
        const lname = document.getElementById('lname');
        if (lname.value.trim() === '') {
            document.getElementById('lnameError').textContent = 'Last name is required';
            isValid = false;
        }

        // Validate Email
        const email = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value)) {
            document.getElementById('emailError').textContent = 'Enter a valid email address';
            isValid = false;
        }

        // Validate Password
        const password = document.getElementById('password');
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%^*#?&])[A-Za-z\d@$!^%*#?&]{8,}$/;
        if (!passwordRegex.test(password.value)) {
            document.getElementById('passwordError').innerHTML =
                `Password should have:<br><ul>
                    <li>Minimum eight characters</li>
                    <li>At least one letter</li>
                    <li>At least one number</li>
                </ul>`;
            isValid = false;
        }

        // Validate Confirm Password
        const confirmPassword = document.getElementById('confirmPassword');
        if (password.value !== confirmPassword.value) {
            document.getElementById('confirmPasswordError').textContent = 'Passwords do not match';
            isValid = false;
        }

        // If valid, submit the form or show a success message
        if (isValid) {
             // now we can submit the form using the below line
            signupForm.submit();
            // You can now submit the form using the below line
            // signupForm.submit(); // Uncomment this to submit the form
        }

       
    });
});
