<?php
include("../connection.php");

// Check if courseid or id is provided in the API request
if (isset($_GET["courseid"])) {
    $courseid = $_GET["courseid"];

    // Fetch course activities by courseid
    $sql_activities = "SELECT * FROM courseactivities WHERE courseid = $courseid ORDER BY dayno";
} elseif (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Fetch course activity by id
    $sql_activities = "SELECT * FROM courseactivities WHERE id = $id";
} else {
    // Fetch all course activities
    $sql_activities = "SELECT * FROM courseactivities ORDER BY dayno";
}

$result = $conn->query($sql_activities);
$dataarray = array();

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tarray = $row;
        $tarray["status"] = 'success';
        array_push($dataarray, $tarray);
    }
    header('Content-Type: application/json');
    echo json_encode(array("data" => $dataarray));
} else {
    // Handle the case where no activities are found
    echo json_encode(array("status" => "error", "message" => "No activities found."));
}
?>
