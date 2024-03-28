
document.addEventListener('DOMContentLoaded', () => {
    const username = localStorage.getItem('username'); // Or sessionStorage
    document.getElementById('welcomeMessage').textContent = `Welcome ${username}!`;
});
document.addEventListener('DOMContentLoaded', () => {
  const usernum = localStorage.getItem('usernum'); // Or sessionStorage
  document.getElementById('currNum').textContent = `${usernum}`;
});
document.addEventListener('DOMContentLoaded', () => {
  // ... other event listeners ...

  const repaymentLink = document.getElementById('menu-item-repayment'); // Make sure to add the 'repayment' class to your Repayment link in custEmpty.html
  if (repaymentLink) {
      repaymentLink.addEventListener('click', (event) => {
          event.preventDefault(); // Prevent following the link
          alert('Please apply for a loan first.');
      });
  }
});
const loanForm = document.getElementById('requestLoan');
  if (loanForm) {
    loanForm.addEventListener('submit', (event) => {
      const loanAmount = document.getElementById('loan-amount').value;
      if (!loanAmount) {
        event.preventDefault(); // Prevent form submission
        alert('Please enter a loan amount first');
      } else {
        // Save the loan amount to localStorage or process it
        localStorage.setItem('amountDue', loanAmount); // Example: Saving the loan amount
        alert('Congratulations! Your loan request has been approved.');
        // Here you would typically send the loan request to the server
      }
    });
  }
;



