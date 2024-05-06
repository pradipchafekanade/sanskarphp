<?php
    include("../connection.php");

    // Retrieve JSON data
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if (isset($_GET["id"])) {
        // If ID is provided, fetch data for that ID
        $id = $_GET["id"];

        // Prepare and execute SQL query
        $sql = "SELECT * FROM courses WHERE id = '$id'";
        $result = $conn->query($sql);

        $dataarray = array();

        // Fetch data and append to dataarray
        while($row = mysqli_fetch_assoc($result)) {
            $tarray = $row;
            array_push($dataarray, $tarray);    
        }

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode(array("data" => $dataarray));
    } else {
        // If no ID is provided, fetch all courses
        $sql = "SELECT * FROM courses";
        $result = $conn->query($sql);

        $dataarray = array();

        // Fetch all data and append to dataarray
        while($row = mysqli_fetch_assoc($result)) {
            $tarray = $row;
            array_push($dataarray, $tarray);    
        }

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode(array("data" => $dataarray));
    }
?>
