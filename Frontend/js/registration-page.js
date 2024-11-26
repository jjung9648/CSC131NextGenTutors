function showRegisterForm(userType) {
    var registerForm = document.getElementById('registration-form');
    registerForm.style.display = 'flex';
    var emailInput = document.getElementById('email');
    var passwordInput = document.getElementById('password');
    emailInput.placeholder = userType.charAt(0).toUpperCase() + userType.slice(1) + ' Email';
    passwordInput.placeholder = userType.charAt(0).toUpperCase() + userType.slice(1) + ' Password';

    // Hide the register options
    var studentCard = document.querySelector('.registerscard');
    var tutorCard = document.querySelector('.registertcard');
    studentCard.style.display = 'none';
    tutorCard.style.display = 'none';

    // Set the user type in a hidden input field
    document.getElementById('user_type').value = userType;
}

document.getElementById('registration-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Get form data
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const userType = document.getElementById('user_type').value;

    // Create an object to hold the form data
    const formData = {
        email: email,
        password: password,
        user_type: userType,
        action: 'register'
    };

    // Send the form data to the server
    fetch('/Backend/combined_login_register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Registration successful!');
                window.location.href = '/Frontend/landing-page.html'; // Redirect to the landing page or another page
            } else {
                alert('Registration failed: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
});