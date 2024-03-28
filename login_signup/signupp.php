<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container">
        <div class="logo-section">
            <!-- Place your logo image here -->
            <img src="logo.png" alt="LoanMe Logo">
        </div>
        <div class="form-section">
            <form action="signup.php" method="POST" onsubmit="return validateForm()">
                <h2>Sign up</h2>
                <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="text" id="first_name" name="first_name">
                    <span class="error-message" id="first-name-error"></span>
                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" id="last_name" name="last_name">
                    <span class="error-message" id="last-name-error"></span>
                </div>
                <div class="form-group">
                    <label for="phone">Phone number</label>
                    <input type="tel" id="phone" name="phone">
                    <span class="error-message" id="phone-error"></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <span class="error-message" id="password-error"></span>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm password</label>
                    <input type="password" id="confirm-password" name="confirm_password">
                    <span class="error-message" id="confirm-password-error"></span>
                </div>
                <button type="submit">Sign Up</button>
            </form>
            
        </div>
    </div>

    <script src="signup.js"></script>
</body>
</html>
