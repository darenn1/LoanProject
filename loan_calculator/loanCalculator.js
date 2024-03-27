document.addEventListener('DOMContentLoaded', function() {
  const loanAmountInput = document.getElementById('loan-amount');
  const repaymentDurationSelect = document.getElementById('loan-duration');
  const amountToReceiveSpan = document.getElementById('amount-to-receive');
  const interestRateSpan = document.getElementById('interest-rate');
  const amountToPayBackSpan = document.getElementById('amount-to-payback');
  const monthlyRepaymentSpan = document.getElementById('monthly-repayment');
  const dueDateSpan = document.getElementById('due-date');

  function updateLoanDetails() {
      const loanAmount = parseFloat(loanAmountInput.value) || 0;
      const repaymentDuration = parseInt(repaymentDurationSelect.value, 10);

      // Check if both loan amount and repayment duration have valid values
      if (!loanAmount || isNaN(repaymentDuration)) {
          // Optionally clear the output fields or set them to default messages
          amountToReceiveSpan.innerHTML = `Amount to receive: `;
          interestRateSpan.innerHTML = `Interest rate: `;
          amountToPayBackSpan.innerHTML = `Amount to pay back: `;
          monthlyRepaymentSpan.innerHTML = `Monthly repayment: `;
          dueDateSpan.innerHTML = `Due date: `;
          return; // Exit the function if conditions are not met
      }

      let interestRate = 0;
      if (repaymentDuration === 6) {
          interestRate = 10;
      } else if (repaymentDuration === 12) {
          interestRate = 15;
      }

      const interest = loanAmount * (interestRate / 100);
      const totalToRepay = loanAmount + interest;
      const monthlyRepayment = totalToRepay / repaymentDuration;

      // Update the DOM
      amountToReceiveSpan.innerHTML = `Amount to receive: ₦${loanAmount.toFixed(2)}`;
      interestRateSpan.innerHTML = `Interest rate: ${interestRate}%`;
      amountToPayBackSpan.innerHTML = `Amount to pay back: ₦${totalToRepay.toFixed(2)}`;
      monthlyRepaymentSpan.innerHTML = `Monthly repayment: ₦${monthlyRepayment.toFixed(2)}`;
      dueDateSpan.innerHTML = `Due date: ${calculateDueDate(repaymentDuration)}`;
  }

  function calculateDueDate(months) {
      const currentDate = new Date();
      currentDate.setMonth(currentDate.getMonth() + months);
      return currentDate.toDateString();
  }

  loanAmountInput.addEventListener('input', updateLoanDetails);
  repaymentDurationSelect.addEventListener('change', updateLoanDetails);

  // Initial update (optional, based on your preference for initial state)
  updateLoanDetails();
});
