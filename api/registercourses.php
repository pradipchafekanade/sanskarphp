<?php
include("../connection.php");

$json = file_get_contents('php://input');
$data = json_decode($json);

if (isset($data->userid, $data->courseid, $data->enrollmentdate, $data->completecourse)) {
    $userid = $data->userid;
    $courseid = $data->courseid;
    $enrollmentdate = $data->enrollmentdate;
    $completecourse = $data->completecourse;

    // Insert into usercourses
    $sqlInsert = "INSERT INTO usercourses(userid, courseid, enrollmentdate, completecourse) ";
    $sqlInsert .= "VALUES ('$userid', '$courseid', '$enrollmentdate', '$completecourse')";
    $conn->query($sqlInsert);
        
    $tarray = array("status" => 'success');
} else {
    $tarray = array("status" => 'error', "message" => 'Invalid data provided.');
}

header('Content-Type: application/json');
echo json_encode($tarray);
?>
