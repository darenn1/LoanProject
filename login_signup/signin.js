function validateForm() {
  // Get the form elements
  const phone = document.getElementById('phone');
  const password = document.getElementById('password');
  const phoneError = document.getElementById('phone-error');
  const passwordError = document.getElementById('password-error');

  // Clear any previous error messages
  phoneError.innerHTML = "";
  passwordError.innerHTML = "";

  // Flag to indicate if there are any errors
  let hasErrors = false;

  // Validate phone number
  if (phone.value === "") {
    phoneError.innerHTML = "Phone number cannot be empty";
    hasErrors = true;
  } else if (isNaN(phone.value)) {
    phoneError.innerHTML = "Phone number can only contain numbers";
    hasErrors = true;
  }

  // Validate password
  if (password.value === "") {
    passwordError.innerHTML = "Please enter your password";
    hasErrors = true;
  }

  // If errors are present, prevent form submission
  if (hasErrors) {
    return false;
  }

  // If no errors, allow form submission
  return true;
}

const form = document.querySelector('form');
form.addEventListener('submit', (event) => {
  event.preventDefault(); // Prevent default form submission

  if (validateForm()) {
    window.location.assign("../customer/custEmpty.html");

      // Here, you would typically proceed with form submission or further processing
  }
});
