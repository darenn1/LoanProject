<?php
include 'database.php'; // Ensure this path is correct

function getMembers($conn){
    $sql = "SELECT COUNT(DISTINCT customer_id) AS number_of_users FROM loans";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)) {
        return $row['number_of_users'];
    } else {
        return 0; // Return 0 if there's an error or no users
    }
}

// Echoing out the number of members as a JSON object
echo json_encode(array("number_of_users" => getMembers($conn)));
?>