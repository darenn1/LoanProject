<?php
// Start session to use session variables
session_start();

// Assuming you have a function to connect to your database
require 'database.php'; // Update with your actual database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Initialize an error array to hold any form validation errors
    $errors = [];

    // Form validation (basic example)
    if (empty($phone)) {
        $errors['phone'] = 'Phone number is required.';
    }
    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    }

    // If there are no errors, proceed with user authentication
    if (count($errors) === 0) {
        // SQL to check if the user exists with the given phone number and password
        $sql = "SELECT * FROM users WHERE phone = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $phone, md5($password)); // Use md5 for simple hashing (consider stronger hashing algorithms for production)
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if user exists
        if ($user = mysqli_fetch_assoc($result)) {
            // User found, set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['phone'] = $user['phone'];
            // Redirect to a logged-in page
            header("Location: dashboard.php");
            exit();
        } else {
            // User not found, set an error message
            $errors['login'] = 'Invalid login credentials.';
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($conn);
?>
