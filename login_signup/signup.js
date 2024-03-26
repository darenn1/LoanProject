function validateForm() {
    // Get the form elements
    const name = document.getElementById('name');
    const phone = document.getElementById('phone');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm-password');
  
    // Clear any previous error messages
    name.nextElementSibling.innerHTML = "";
    phone.nextElementSibling.innerHTML = "";
    password.nextElementSibling.innerHTML = "";
    confirmPassword.nextElementSibling.innerHTML = "";
  
    // Error messages (if any)
    let errorMessage = "";
  
    // Validate name (at least one field must be filled)
    if (name.value.trim() === "" && name.nextElementSibling.id === "name-error") {
      errorMessage += "Please enter your first name or last name. <br>";
    }
  
    // Validate phone number
    if (phone.value === "") {
      errorMessage += "Please enter your phone number. <br>";
    } else if (isNaN(phone.value)) {
      errorMessage += "Phone number can only contain numbers. <br>";
    }
  
    // Validate password
    if (password.value === "") {
      errorMessage += "Please enter your password. <br>";
    } else if (password.value.length < 6) {
      errorMessage += "Password must be at least 6 characters long. <br>";
    }
  
    // Validate confirm password
    if (confirmPassword.value === "") {
      errorMessage += "Please confirm your password. <br>";
    } else if (confirmPassword.value !== password.value) {
      errorMessage += "Passwords do not match. <br>";
    }
  
    // Display error message (if any)
    if (errorMessage !== "") {
      alert(errorMessage);
      return false;
    }
  
    // If no errors, simulate sending OTP (replace with actual logic)
    alert("OTP sent to your phone number!");
    return true;
  }
  
  const form = document.querySelector('form');
  form.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent default form submission
  
    if (validateForm()) {
      // Form is valid, process form data here (e.g., send to server for signup)
    }
  });
  