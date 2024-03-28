<?php
// Include your database connection script
require 'database.php';


function signupauth($conn){

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assigning posted data to variables
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
    
        // Validation (This is a simple example; you should perform more comprehensive validation and sanitation)
        $errors = [];
        if (empty($firstName)) {
            $errors['first_name'] = 'First name is required.';
        }
        if (empty($lastName)) {
            $errors['last_name'] = 'Last name is required.';
        }
        // Add more validations as necessary
    
        if ($password !== $confirmPassword) {
            $errors['password'] = 'Passwords do not match.';
        }
    
        // If there are no errors, proceed with user registration
        if (count($errors) === 0) {
            // Hash the password before saving to the database
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert the new user into the database
            // You should prepare the statement to prevent SQL injection
            $sql = "INSERT INTO users (first_name, last_name, phone, password) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ssss', $firstName, $lastName, $phone, $passwordHash);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "Registration successful!";
                // Redirect to login page or somewhere else
            } else {
                echo "Error: " . mysqli_error($conn);
            }
    
            if (mysqli_stmt_execute($stmt)) {
                echo "Registration successful!";
                // Redirect to login page or somewhere else
                header('Location: ../customer/custEmpty.html'); // Redirect after successful signup
                exit;
            }
        } else {
            // Handle errors, e.g., by displaying them to the user
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
        }
    }

    
}


echo json_encode(array("signup_details" => signupauth($conn)));

// Check if the form is submitted

?>
