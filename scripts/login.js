const loginForm = document.querySelector('.login-form');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');


loginForm.addEventListener('submit', function(event) {
    event.preventDefault();
    let valid = true;

    //email validation
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailRegex.test(emailInput.value)) {
        emailError.innerHTML= 'Invalid email';
        valid = false;
    } else {
        emailError.innerHTML = '';
    }

    //password validation
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\W]{8,}$/; //Minimum eight characters, at least one letter and one number
    if (!passwordRegex.test(passwordInput.value)) {
        passwordError.innerHTML = `Invalid!!. Password should have` + '<br>' + '<ul>' + '<li>Minimum eight characters</li>' + '<li>At least one letter</li>' + '<li>At least one number</li>' + '</ul>';
        valid = false;
    } else {
        passwordError.innerHTML = '';
    }

    if (valid) {
        alert('Login successful!!!');
    }
});