function showRegisterForm(userType) {
    var registerFormStudent = document.getElementById('register-form-student');
    var registerFormTutor = document.getElementById('register-form-tutor');

    if (userType === 'student') {
        registerFormStudent.style.display = 'block';
        registerFormTutor.style.display = 'none';
    } else if (userType === 'tutor') {
        registerFormStudent.style.display = 'none';
        registerFormTutor.style.display = 'block';
    }

    var emailInput = document.getElementById(userType + '-email');
    var passwordInput = document.getElementById(userType + '-password');
    emailInput.placeholder = userType.charAt(0).toUpperCase() + userType.slice(1) + ' Email';
    passwordInput.placeholder = userType.charAt(0).toUpperCase() + userType.slice(1) + ' Password';

    // Set the user type in a hidden input field
    document.getElementById(userType + '_user_type').value = userType;
}

function showLoginForm(userType) {
    var loginst = document.getElementById('loginst');
    var logaftert = document.getElementById('logaftert');

    if (userType === 'student') {
        loginst.style.display = 'block';
        logaftert.style.display = 'none';
    } else if (userType === 'tutor') {
        loginst.style.display = 'none';
        logaftert.style.display = 'block';
    }

    var emailInput = document.getElementById('email');
    var passwordInput = document.getElementById('password');
    emailInput.placeholder = userType.charAt(0).toUpperCase() + userType.slice(1) + ' Email';
    passwordInput.placeholder = userType.charAt(0).toUpperCase() + userType.slice(1) + ' Password';

    // Set the user type in a hidden input field
    document.getElementById('user_type').value = userType;
}

document.addEventListener('DOMContentLoaded', function () {
    var loginForm = document.getElementById('login-form');
    var registerFormStudent = document.getElementById('register-form-student-form');
    var registerFormTutor = document.getElementById('register-form-tutor-form');


    if (loginForm) {
        loginForm.addEventListener('submit', function (event) {
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
                .then(response => response.json()) // Parse JSON response
                .then(data => {
                    console.log('Parsed Response Data:', data); // Print the response data to the console
                    const messageElement = document.getElementById('login-message');
                    if (data.success) {
                        messageElement.textContent = 'Login successful!';
                        messageElement.style.color = 'green';
                        // Redirect or perform other actions on successful login
                        if (userType === 'student') {
                            window.location.href = '/Frontend/studentdash.html';
                        } else if (userType === 'tutor') {
                            window.location.href = '/Frontend/tutor-dashboard.html';
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

    }

    if (registerFormStudent) {
        registerFormStudent.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            const email = document.getElementById('student-email').value;
            const password = document.getElementById('student-password').value;
            const userType = document.getElementById('student_user_type').value;

            // Create an object to hold the form data
            const formData = {
                email: email,
                password: password,
                user_type: userType,
                action: 'register'
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
                .then(response => response.json()) // Parse JSON response
                .then(data => {
                    console.log('Parsed Response Data:', data); // Print the response data to the console
                    const messageElement = document.getElementById('register-message-student');
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
                    const messageElement = document.getElementById('register-message-student');
                    messageElement.textContent = 'An error occurred. Please try again.';
                    messageElement.style.color = 'red';
                });
        });
    }

    if (registerFormTutor) {
        registerFormTutor.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            const email = document.getElementById('tutor-email').value;
            const password = document.getElementById('tutor-password').value;
            const userType = document.getElementById('tutor_user_type').value;

            // Create an object to hold the form data
            const formData = {
                email: email,
                password: password,
                user_type: userType,
                action: 'register'
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
                .then(response => response.json()) // Parse JSON response
                .then(data => {
                    console.log('Parsed Response Data:', data); // Print the response data to the console
                    const messageElement = document.getElementById('register-message-tutor');
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
                    const messageElement = document.getElementById('register-message-tutor');
                    messageElement.textContent = 'An error occurred. Please try again.';
                    messageElement.style.color = 'red';
                });
        });
    }
});

