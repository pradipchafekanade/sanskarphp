<?php
include("../connection.php");

// Check if userid is provided
if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM useractivities WHERE userid = '$userid'";
    $result = $conn->query($sql);

    if ($result) {
        $dataarray = array();

        // Fetch all data and append to dataarray
        while ($row = mysqli_fetch_assoc($result)) {
            // Append each row to the dataarray 
            $dataarray[] = $row;
        }
        $response = $dataarray;
    } else {
        $response = array("error" => "Failed to execute query");
    }
} else {
    $response = array("error" => "No userid provided");
}

header('Content-Type: application/json');
echo json_encode($response);
?>
