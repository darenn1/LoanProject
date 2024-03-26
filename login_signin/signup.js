// Function to handle form submission
function handleFormSubmission(event) {
    event.preventDefault(); // Prevent default form submission behavior
  
    // Get phone number and password values from the form
    const phoneNumber = document.querySelector('.input').value;
    const password = document.querySelector('.div').innerText;
  
    // Perform validation on the input fields (you can customize this part)
    if (phoneNumber.trim() === '') {
      alert('Please enter your phone number');
      return;
    }
  
    if (password.trim() === '') {
      alert('Please enter your password');
      return;
    }
  
    // If validation passes, you can proceed with form submission or other actions
    // For demonstration purposes, let's just log the values to the console
    console.log('Phone Number:', phoneNumber);
    console.log('Password:', password);
  
    // You can also submit the form programmatically if needed
    // document.querySelector('form').submit();
  }
  
  // Function to handle "Sign in" link click
  function handleSignInLinkClick() {
    // Redirect user to the sign-in page or perform any other action
    console.log('Redirecting to sign-in page...');
  }
  
  // Add event listeners to form submission and "Sign in" link
  document.addEventListener('DOMContentLoaded', function () {
    // Add event listener for form submission
    document.querySelector('form').addEventListener('submit', handleFormSubmission);
  
    // Add event listener for "Sign in" link click
    document.querySelector('.sign-in').addEventListener('click', handleSignInLinkClick);
  });
  