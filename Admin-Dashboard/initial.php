<?php

header('Content-Type: application/json');

$servername = 'localhost';
$username = 'root';
$password = 'HelloWorld';
$dbname = 'LoanMe';

/*
$customerid = isset($_GET['customer_id']) ? $_GET['customer_id'] : null;
$date = $_GET['date'];
$loanamount = $_GET['loan'];
$repaymentduration = $_GET['duration'];
$timeelapsed = $_GET['duration'];
$amountrepayed = $_GET['repayment'];
$amountdue = $loanamount;
$loanstatus
*/
$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    die('Connection Failed'.mysqli_connect_error());
}else{ 


    function getDetails($conn) {
        $selectall = "SELECT * FROM loans";
        $rows = []; // Initialize an empty array to store rows

        $result = mysqli_query($conn, $selectall);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row; // Append each row to the array
            }
            // Write the JSON encoded array to the data.json file
            file_put_contents('data.json', json_encode($rows));
            return $rows; // Return the array containing all rows
        } else {
            die('An Error occurred: ' . mysqli_error($conn));
        }
    } 

function getMembers(){
    $sql = "SELECT COUNT(DISTINCT customer_id) AS number_of_users FROM loans";

    $result = mysqli_query($conn,$sql);

    return $result;    
}

function overdueloans($conn){
    // Get current date
    $datenow = date('Y-m-d');

    // SQL query to count overdue loans
    $sql = "SELECT COUNT(*) AS overdue_count 
            FROM Loans 
            WHERE date_due < '$datenow' 
            AND loan_status = 'ongoing'";

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    /*
    if ($result) {
        // Fetch the result
        $row = mysqli_fetch_assoc($result);
        $overdue_count = $row['overdue_count'];
        
        // Free

    }*/

    return $result;
}

function fullypaid($conn){
    $sql = "SELECT COUNT(*) AS completed_payment
            FROM Loans 
            WHERE loan_status = 'paid'";

    $result = mysqli_query($conn, $sql);

    return $result;
}

function get_customer_by_id($conn, $customerid) {
    $sql = "SELECT * FROM Loans WHERE customer_id = $customerid";
    $result = mysqli_query($conn, $sql);
    
    // Check if any rows are returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch and return customer data as an associative array
        return mysqli_fetch_assoc($result);
    } else {
        // If no rows found, return false
        return false;
    }
}

    /*
    // Fetch and return customer data if found, otherwise return false
    if (mysqli_num_rows($result) > 0) {
        $customer = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $customer;
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }*/


/*
    $stmt = mysqli_prepare($conn, $sql);
   

    mysqli_stmt_bind_param($stmt, "i", $customerid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);*/

    function takeloan($conn, $customerid, $customer_name, $loanamount, $repaymentduration) {
        $datenow = date('Y-m-d');
        $amount_paid = 0;
        
        $repaymentduration_in_days = $repaymentduration * 30;
        $datedue_timestamp = strtotime($datenow . ' +' . $repaymentduration_in_days . ' days');
        $datedue = date('Y-m-d', $datedue_timestamp);
        $loanstatus = 'ongoing';
      
        if($repaymentduration == 6){
            $amount_due = $loanamount + $loanamount * 0.10;
        }elseif($repaymentduration == 12){
            $amount_due = $loanamount + $loanamount * 0.15;
        }
      
        // Escape string values to prevent SQL injection
        $customer_name = mysqli_real_escape_string($conn, $customer_name);
        $loanstatus = mysqli_real_escape_string($conn, $loanstatus);
      
        $sql = "INSERT INTO Loans (customer_id, customer_name, loan_amount, amount_paid, amount_due, date_taken, repayment_duration, date_due, loan_status) 
                VALUES ('$customerid', '$customer_name', '$loanamount', '$amount_paid', '$amount_due', '$datenow', '$repaymentduration', '$datedue', '$loanstatus')";
        
        $result = mysqli_query($conn, $sql);
      
        if ($result) {
            echo "Loan granted successfully.";
        } else {
            echo "Error granting loan: " . mysqli_error($conn);
        }
      
        exit; // Now placed inside the if block
      }
      

  
  

    /*
    // Check if customer ID exists (already implemented in your previous code)
    $sql = "SELECT * FROM customers WHERE customer_id = $customerid";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $customerid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $exists = mysqli_num_rows($result) > 0;
    mysqli_stmt_close($stmt);
  
    if (!$exists) {
        echo "Customer ID not found.";
        return; // Exit the function if customer doesn't exist
    } */
  
    // Additional checks before granting loan (optional)
    // ... Implement logic to check eligibility based on bank balance, existing loans etc. ...
  
    // Grant the loan if all checks pass


  
    function repayloan($conn, $customerid, $amountrepayed) {
        // Retrieve loan details using checkloan function
        $loan_details = checkloan($conn, $customerid);
    
        if ($loan_details) {
            $amount_tobe_paid = $loan_details['amount_due'];
    
            // Check if the amount to be repaid is less than or equal to the loan amount
            if ($amountrepayed < $amount_tobe_paid) {
                $amount_tobe_paid -= $amountrepayed;
                // Update the loan amount in the database
                $sql = "UPDATE loans SET amount_due = $amount_tobe_paid WHERE customer_id = $customerid";
    
                $result = mysqli_query($conn, $sql);
                exit;
                if($amount_tobe_paid == 0){
                    $sql = "UPDATE loans SET loan_status = 'paid' WHERE customer_id = $customerid";
                    $result = mysqli_query($conn, $sql);
                    exit;
                }
                if ($result) {
                    echo "Loan repayment successful. Remaining loan amount: $amount_tobe_paid";
                } else {
                    echo 'Error updating loan amount: ' . mysqli_error($conn);
                }
            }elseif($amountrepayed == $amount_tobe_paid){
                $sql = "UPDATE loans SET loan_status = 'paid' WHERE customer_id = $customerid";
                $result = mysqli_query($conn, $sql);

                $sql = "UPDATE loans SET amount_due = 0 WHERE customer_id = $customerid";
                $result = mysqli_query($conn,$sql);

            }
            else {
                echo 'The amount you want to repay is more than the loan taken';
            }
        } else {
            echo 'No loan found for this customer.';
        }


        // once amount is fully paid update loan status 
        // overdue date (if overdue )
    }
    

function checkloan($conn, $customerid) {
    $customer = get_customer_by_id($conn, $customerid);
    if ($customer) {
        // Get loan details associated with the customer
        $sql = "SELECT * FROM loans WHERE customer_id = $customerid";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $loan_data = mysqli_fetch_assoc($result);
            return $loan_data;
            // Process loan details and return them
            //echo 'Name: ' . $customer['customer_name'] . ', Loan Amount: ' . $loan_data['loan_amount'] . ', Date Due: ' . $loan_data['date_due'] . ', Repayment Duration: ' . $loan_data['repayment_duration'];
        } else {
            return 'No loan found for this customer.';
        }
    } else {
        return 'Customer not found.';
    }
}

function loancalculator($conn,$amount, $repaymentduration){
    //This function is to calculate how much a user would be required to pay 

    if($repaymentduration == 6){
        $amount_tobe_paid = $amount + $amount * 0.10;
    }elseif($repaymentduration == 12){
        $amount_tobe_paid = $amount + $amount * 0.15;
    }
}




/*
if ($repaymentduration == 6){
    $timeelapsed;
}*/


/*
Customer DB 
Action 1 : Get customer details by their individual id [see everything from the admin standpoint]
Action 2 : Take Loan (based on bank balance can only do x10)
Action 3 : repay the loan (bank balance, amount to be repaid , timeline left)
Action 4 : check date loan was taking and repayment timeline 
Action 5 : see debtor repayment plan (amount taken and balance left)

Optional Action: 
can do a bank balance for repaying the loan?

ACtion to do: 

Action 1 : Loan CAlculator 
authenti



you must be an exiting customer to take a loan 

*/

//takeloan($conn, 2005, 'Awele Osagi', 40000000, 6);

//checkloan($conn,2001);

//repayloan($conn,2003,3000);

$users = getDetails($conn);

echo json_encode($users);


}



?>
