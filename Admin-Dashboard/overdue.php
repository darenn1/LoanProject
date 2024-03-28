<?php
include 'database.php'; // Ensure this path is correct

function getOverdueCount($conn){
    $sql = "SELECT COUNT(*) AS overdue_payment FROM Loans WHERE loan_status = 'overdue'";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)) {
        return $row['overdue_payment'];
    } else {
        return 0; // Return 0 if there's an error or no fully paid loans
    }
}

// Echo out the count of fully paid loans as JSON
echo json_encode(array("overdue_payment" => getOverdueCount($conn)));
?>
