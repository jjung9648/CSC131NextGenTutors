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

    console.log('Request Data: ', formData); // Log the form data

    // Send the form data to the server
    fetch('/Backend/includes/combined_login_register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
        .then(response => response.text()) // Get raw response text
        .then(text => {
            console.log('Raw Response Text:', text);
            try {
                return JSON.parse(text); // Parse JSON
            } catch (error) {
                console.error('Error parsing JSON:', error);
                throw new Error('Invalid JSON response');
            }
        })
        .then(data => {
            console.log('Parsed Response Data:', data); // Print the response data to the console
            const messageElement = document.getElementById('login-message');
            if (data.success) {
                messageElement.textContent = 'Login successful!';
                messageElement.style.color = 'green';
                if (userType === 'student') {
                    window.location.href = '/Frontend/student-dashboard.html'; // Redirect to the student dashboard
                } else if (userType === 'tutor') {
                    window.location.href = '/Frontend/tutor-dashboard.html'; // Redirect to the tutor dashboard
                }
            } else {
                messageElement.textContent = 'Login failed: ' + data.message;
                messageElement.style.color = 'red';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const messageElement = document.getElementById('login-message');
            messageElement.textContent = 'An error occurred. Please try again.';
            messageElement.style.color = 'red';
        });
});

document.getElementById('register-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Get form data
    const email = document.getElementById('register-email').value;
    const password = document.getElementById('register-password').value;
    const userType = document.getElementById('register-user-type').value;

    // Create an object to hold the form data
    const formData = {
        email: email,
        password: password,
        user_type: userType,
        action: 'register'
    };

    // Send the form data to the server
    fetch('/Backend/includes/combined_login_register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
        .then(response => response.text()) // Get raw response text
        .then(text => {
            console.log(text); // Log raw response text
            try {
                return JSON.parse(text); // Parse JSON
            } catch (error) {
                console.error('Error parsing JSON:', error);
                throw new Error('Invalid JSON response');
            }
        })
        .then(data => {
            console.log(data); // Print the response data to the console
            const messageElement = document.getElementById('register-message');
            if (data.success) {
                messageElement.textContent = 'Registration successful!';
                messageElement.style.color = 'green';
            } else {
                messageElement.textContent = 'Registration failed: ' + data.message;
                messageElement.style.color = 'red';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const messageElement = document.getElementById('register-message');
            messageElement.textContent = 'An error occurred. Please try again.';
            messageElement.style.color = 'red';
        });
});