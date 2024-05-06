<?php
    include("../connection.php");
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    // Check if the "id" parameter is set in the URL
    if (isset($_GET['id'])) {
        $id = $_GET["id"];
        // $id = intval($_GET['id']);
        $sql = "SELECT * FROM users WHERE id = $id";
    } else {
        $sql = "SELECT * FROM users";
    }

    $result = $conn->query($sql);
    $dataarray = array();

    while($row = mysqli_fetch_assoc($result)) {
        $tarray = $row;
        $tarray["status"] = 'success';
        array_push($dataarray, $tarray);
    }

    header('Content-Type: application/json');
    echo json_encode( $dataarray);
    
?>