<?php
include("../connection.php");

$id = $_POST['id'];
$name = $_POST['name'];
$days = $_POST['days'];
$status = $_POST['status'];
$information = $_POST['information'];

if ($id == 0) {
    $query = "INSERT INTO courses (name, days, status,information) VALUES ('$name', '$days', '$status','$information')";
    if ($conn->query($query) === TRUE) {
        $id = mysqli_insert_id($conn);
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
        exit;
    }
} else {
    $query = "UPDATE courses SET name = '$name', days = '$days', status = '$status',information='$information' WHERE id = $id";
    if ($conn->query($query) !== TRUE) {
        echo "Error: " . $query . "<br>" . $conn->error;
        exit;
    }
}

if ($_FILES["imagepath"]["tmp_name"] !== "") {
    $imagename = "image_" . $id;
    $target_dir = '../coursespics/' . $imagename .'.png';

    if (move_uploaded_file($_FILES["imagepath"]["tmp_name"], $target_dir)) {
        $query = "UPDATE courses SET imagepath = '" . $imagename . "' WHERE id = " . $id;
        if ($conn->query($query) !== TRUE) {
            echo "Error: " . $query . "<br>" . $conn->error;
            exit;
        }
    } else {
        echo "File upload failed.";
        exit;
    }
}

header('Location: courses.php');
?>
