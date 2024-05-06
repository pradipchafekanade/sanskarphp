<?php
include("../connection.php");

// Check if userid is provided in the URL
if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    // Fetch data based on userid
    // $sqlSelect = "SELECT * FROM usercourses WHERE userid = '$userid'";
    $sqlSelect = "SELECT*
    FROM courses
    INNER JOIN usercourses ON courses.id=usercourses.courseid WHERE userid='$userid' ";
    $result = $conn->query($sqlSelect);

    if ($result->num_rows > 0) {
        $courses = array();
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }
        $tarray = array("status" => 'success', "usercourses" => $courses);
    } else {
        $tarray = array("status" => 'error', "message" => 'No courses found for the provided userid.', "usercourses" => array());
    }
} else {
    $tarray = array("status" => 'error', "message" => 'Invalid data provided.', "usercourses" => array());
}

header('Content-Type: application/json');
echo json_encode($tarray);
?>
