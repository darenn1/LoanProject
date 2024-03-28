document.addEventListener('DOMContentLoaded', function() {
    fetch('initial.php')
        .then(response => response.json())
        .then(data => {
            renderLoanDetails(data);
            addSearchFunctionality(data);
        })
        .catch(error => console.error('Error fetching loan details:', error));
});

function renderLoanDetails(data) {
    const container = document.getElementById('loanDetailsContainer');
    container.innerHTML = ''; // Clear existing content

    data.forEach(item => {
        const loanDetailRow = document.createElement('div');
        loanDetailRow.classList.add('loan-detail-row');
        loanDetailRow.innerHTML = `
            <div>${item.customer_name}</div>
            <div>${item.loan_amount}</div>
            <div>${item.amount_paid}</div>
            <div>${item.amount_due}</div>
            <div>${item.date_taken}</div>
            <div>${item.date_due}</div>
            <div>${item.repayment_duration}</div>
            <div class="${item.loan_status.toLowerCase()}">${item.loan_status}</div>
        `;
        container.appendChild(loanDetailRow);
    });
}

//herd by laravel

function addSearchFunctionality(fullData) {
    const searchInput = document.querySelector('.text-cursor3');
    searchInput.addEventListener('input', () => {
        const filteredData = fullData.filter(item => 
            item.customer_name.toLowerCase().includes(searchInput.value.toLowerCase()));
        renderLoanDetails(filteredData);
    });
}


function fetchMemberCount() {
    fetch('getMembers.php') // Ensure this path is correct
        .then(response => response.json())
        .then(data => {
            document.querySelector('.wrapper .div').textContent = data.number_of_users;
            document.querySelector('.text43 .div1').textContent = data.number_of_users;
       
        })
        .catch(error => console.error('Error fetching member count:', error));
}

// Call the function when the page loads
document.addEventListener('DOMContentLoaded', function() {
    // Existing fetch calls...
    fetchMemberCount(); // New function call
});

// Add this function to script.js
document.addEventListener('DOMContentLoaded', function() {
    // Fetch Fully Paid Loans Count
    fetch('fullypaid.php')
        .then(response => response.json())
        .then(data => {
            document.querySelector('.wrapper3 .div5').textContent = data.completed_payment;
        })
        .catch(error => console.error('Error fetching fully paid loans count:', error));

    // Fetch Total Amount Disbursed
    fetch('amount.php')
        .then(response => response.json())
        .then(data => {
            const formattedAmount = `₦${parseFloat(data.total_amount_distributed).toLocaleString('en-US')}`;
            document.getElementById('totalAmountDisbursed').textContent = formattedAmount;
        })
        .catch(error => console.error('Error fetching total amount disbursed:', error));

    
    

    // Fetch Outstanding Loans
    fetch('outstanding.php')
        .then(response => response.json())
        .then(data => {
            document.querySelector('.div2').textContent = data.outstanding_loans;
        })
        .catch(error => console.error('Error fetching outstanding loans:', error));
});


function fetchOverdueLoans() {
    fetch('overdue.php')
        .then(response => response.json())
        .then(data => {
            // Ensure the selector matches the element where you want to display the count
            document.querySelector('.connected-components').textContent = data.overdue_payment;
        })
        .catch(error => console.error('Error fetching overdue loans:', error));
}

// Ensure this is called once the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    fetchOverdueLoans();
});
