function showLoginForm(userType) {
    var loginForm = document.getElementById('login-form');
    loginForm.style.display = 'flex';
    var emailInput = document.getElementById('email');
    var passwordInput = document.getElementById('password');
    emailInput.placeholder = userType.charAt(0).toUpperCase() + userType.slice(1) + ' Email';
    passwordInput.placeholder = userType.charAt(0).toUpperCase() + userType.slice(1) + ' Password';

    // Hide the sign-in options
    var studentCard = document.querySelector('.log-instudentcard');
    var tutorCard = document.querySelector('.log-intutorcard');
    studentCard.style.display = 'none';
    tutorCard.style.display = 'none';

    // Set the user type in a hidden input field
    document.getElementById('user_type').value = userType;
}

document.getElementById('login-form').addEventListener('submit', function (event) {
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
        action: 'login'
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
                alert('Login successful!');
                if (userType === 'student') {
                    window.location.href = '/Frontend/student-dashboard.html'; // Redirect to the student dashboard
                } else if (userType === 'tutor') {
                    window.location.href = '/Frontend/tutor-dashboard.html'; // Redirect to the tutor dashboard
                }
            } else {
                alert('Login failed: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
});