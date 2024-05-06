<?php
include("../connection.php");

$json = file_get_contents('php://input');
$data = json_decode($json);

if (isset($data->userid, $data->courseid, $data->activitydate, $data->status, $data->activityid, $data->description)) {
    $userid = $data->userid;
    $courseid = $data->courseid;
    $activitydate = $data->activitydate;
    $status = $data->status;
    $activityid = $data->activityid;
    $description = $data->description;

    // Insert into useractivities
    $sqlInsert = "INSERT INTO useractivities(userid, courseid, activitydate, status,activityid,description) ";
    $sqlInsert .= "VALUES ('$userid', '$courseid', '$activitydate', '$status','$activityid','$description')";
    $conn->query($sqlInsert);

    $tarray = array("status" => 'success');
} else {
    // If no ID is provided, fetch all activities
    $sql = "SELECT * FROM useractivities";
    $result = $conn->query($sql);

    $dataarray = array();

    // Fetch all data and append to dataarray
    while ($row = mysqli_fetch_assoc($result)) {
        // Append each row to the dataarray
        $dataarray[] = $row;
    }
    $tarray = $dataarray; // Assign dataarray to tarray
}

header('Content-Type: application/json');
echo json_encode($tarray);
?>
