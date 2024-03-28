<?php
include 'database.php'; // Make sure this path is correct

// SQL query to sum up all the loan amounts
$sql = "SELECT SUM(loan_amount) AS total_amount_distributed FROM Loans";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}

$row = mysqli_fetch_assoc($result);
$total_amount_distributed = $row['total_amount_distributed'];

// Echo out the total amount distributed as a JSON object
echo json_encode(array("total_amount_distributed" => $total_amount_distributed));

?>
