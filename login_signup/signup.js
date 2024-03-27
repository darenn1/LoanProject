function saveUsername() {
  const username = document.getElementById('first_name').value;
  localStorage.setItem('username', username);
   // Use sessionStorage if the data should only last for the session
}
function saveUsernum(){
  const usernum = document.getElementById('phone').value;
  localStorage.setItem('usernum', usernum);
}

function validateForm() {
    // Get the form elements
    const firstName = document.getElementById('first_name');
    const lastName = document.getElementById('last_name');
    const phone = document.getElementById('phone');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm-password');
    const firstNameError = document.getElementById('first-name-error');
    const lastNameError = document.getElementById('last-name-error');
    const phoneError = document.getElementById('phone-error');
    const passwordError = document.getElementById('password-error');
    const confirmPasswordError = document.getElementById('confirm-password-error');
  
    // Clear any previous error messages
    firstNameError.innerHTML = "";
    lastNameError.innerHTML = "";
    phoneError.innerHTML = "";
    passwordError.innerHTML = "";
    confirmPasswordError.innerHTML = "";
  
    // Error messages (if any)
    let hasErrors = false;
  
    // Validate first name
    if (firstName.value.trim() === "") {
        firstNameError.innerHTML = "Please enter your first name.";
        hasErrors = true;
    }

    // Validate last name
    if (lastName.value.trim() === "") {
        lastNameError.innerHTML = "Please enter your last name.";
        hasErrors = true;
    }
  
    // Validate phone number
    if (phone.value === "") {
      phoneError.innerHTML = "Please enter your phone number.";
      hasErrors = true; 
    } else if (isNaN(phone.value)) {
      phoneError.innerHTML = "Phone number can only contain numbers.";
      hasErrors = true;
    }
  
    // Validate password
    if (password.value === "") {
      passwordError.innerHTML = "Please enter your password.";
      hasErrors = true;
    } else if (password.value.length < 6) {
      passwordError.innerHTML = "Password must be at least 6 characters long.";
      hasErrors = true;
    }
  
    // Validate confirm password
    if (confirmPassword.value === "") {
      confirmPasswordError.innerHTML = "Please confirm your password.";
      hasErrors = true;
    } else if (confirmPassword.value !== password.value) {
      confirmPasswordError.innerHTML = "Passwords do not match.";
      hasErrors = true;
    }
  
    // Display error message (if any)
    if (hasErrors) {
      return false;
    }
  
    // If no errors, simulate sending OTP (replace with actual logic)
    
    return true;
  }
  
  const form = document.querySelector('form');
  form.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent default form submission
  
    if (validateForm()) {
      saveUsername();
      saveUsernum();
      window.location.assign("../customer/custEmpty.html");
      // Form is valid, process form data here (e.g., send to server for signup)
    }
  });

  