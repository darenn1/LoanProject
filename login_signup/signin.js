function validateForm() {
    // Get the form elements
    const phone = document.getElementById('phone');
    const password = document.getElementById('password');
  
    // Clear any previous error messages
    phone.nextElementSibling.innerHTML = "";
    password.nextElementSibling.innerHTML = "";
  
    // Error messages (if any)
    let errorMessage = "";
  
    // Validate phone number
    if (phone.value === "") {
      errorMessage += "Please enter your phone number. <br>";
    } else if (isNaN(phone.value)) {
      errorMessage += "Phone number can only contain numbers. <br>";
    }
  
    // Validate password
    if (password.value === "") {
      errorMessage += "Please enter your password.";
    }
  
    // Display error message (if any)
    if (errorMessage !== "") {
      alert(errorMessage);
      return false;
    }
  
    // If no errors, submit the form
    return true;
  }
  
  const form = document.querySelector('form');
  form.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent default form submission
  
    if (validateForm()) {
      // Form is valid, process form data here (e.g., send to server)
      // For this example, we'll just simulate a successful login with an alert
      alert("Login successful!");
    }
  });
  