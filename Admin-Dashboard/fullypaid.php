<?php
include 'database.php'; // Ensure this path is correct

function getFullyPaidCount($conn){
    $sql = "SELECT COUNT(*) AS completed_payment FROM Loans WHERE loan_status = 'paid'";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)) {
        return $row['completed_payment'];
    } else {
        return 0; // Return 0 if there's an error or no fully paid loans
    }
}

// Echo out the count of fully paid loans as JSON
echo json_encode(array("completed_payment" => getFullyPaidCount($conn)));
?>
