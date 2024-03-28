<?php
include 'database.php'; // Include your database connection

header('Content-Type: application/json'); // Set correct content type for JSON response

function getOutstandingLoansCount($conn) {
    $sql = "SELECT COUNT(*) AS outstanding_loans FROM Loans WHERE loan_status = 'ongoing'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['outstanding_loans'];
    } else {
        return 0; // Return 0 if there's an error
    }
}

$outstandingLoansCount = getOutstandingLoansCount($conn);
echo json_encode(['outstanding_loans' => $outstandingLoansCount]);
?>
