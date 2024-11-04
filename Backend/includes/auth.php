<?php
// auth.php

function registerUser($conn, $email, $password) {
      // Hash the password using a secure hashing algorithm
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      // Prepare an SQL statement to insert the new user's email and hashed password into the users table
      $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
  
      // Bind the email and hashed password parameters to the SQL statement
      $stmt->bind_param("ss", $email, $hashedPassword);
  
      // Execute the SQL statement and return the result (true if successful, false otherwise)
      return $stmt->execute();
}

function signInUser($conn, $email, $password) {
    // Prepare an SQL statement to select the user with the given email from the users table
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");

    // Bind the email parameter to the SQL statement
    $stmt->bind_param("s", $email);

    // Execute the SQL statement
    $stmt->execute();

    // Get the result of the executed statement
    $result = $stmt->get_result();

    // Check if exactly one user was found
    if ($result->num_rows === 1) {
        // Fetch the user's data as an associative array
        $user = $result->fetch_assoc();

        // Verify the provided password against the stored hashed password
        if (password_verify($password, $user['password'])) {
            // Return the user's data if the password is correct
            return $user;
        }
    }

    // Return false if the user was not found or the password is incorrect
    return false;
}
?>