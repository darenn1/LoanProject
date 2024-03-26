// Select the form element
const loginForm = document.querySelector('.no-account-message form');

// Add event listener for form submission
loginForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent default form submission behavior

  // Get phone number and password values from input fields
  const phoneNumberInput = document.querySelector('.input');
  const phoneNumber = phoneNumberInput.value;
  const passwordInput = document.querySelector('.divider1 .div1'); // Assuming password field is within the second `.divider1` element with class `.div1`
  const password = passwordInput.textContent; // Get text content of the password field (assuming it's not an input type="password")

  // Basic validation (replace with more robust validation if needed)
  let isValid = true;
  if (phoneNumber.trim() === '') {
    isValid = false;
    console.error('Phone number cannot be empty.');
  }
  if (password.trim() === '') {
    isValid = false;
    console.error('Password cannot be empty.');
  }

  if (isValid) {
    // Simulate sending data to a server (replace with your actual logic)
    console.log(`Submitted login request: Phone Number: ${phoneNumber}, Password: ${password}`);
    console.log('Login successful!'); // Simulate success message
  } else {
    // Display error message (optional - you can add visual cues on the page)
    console.error('Please enter a valid phone number and password.');
  }
});
