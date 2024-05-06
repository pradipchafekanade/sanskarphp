<?php
include("../connection.php");


$courseid = $_POST['courseid'];
$id = $_POST['id'];
$dayno = $_POST['dayno'];
$atype = $_POST['atype'];

if($atype == "Text"){
    $description = $_POST['description'];
}
else if($atype == "Audio"){
    if ($_FILES["audiofile"]["tmp_name"] !== "") {
        $description = "audio_" . $courseid . "-" . $dayno . ".mp3";
        $target_dir = '../activityaudios/' . $description;    
        move_uploaded_file($_FILES["audiofile"]["tmp_name"], $target_dir);
    }
}
else if($atype == "Video"){

    $description = $_POST['videofile'];
    // if ($_FILES["videofile"]["tmp_name"] !== "") {
    //     $description = "video" . $courseid . "-" . $dayno . ".mp4";
    //     $target_dir = '../activityvideos/' . $description;    
    //     move_uploaded_file($_FILES["videofile"]["tmp_name"], $target_dir);
    // };
}


if ($id == 0) {
    $query = "INSERT INTO courseactivities(courseid, atype, description, dayno) ";
    $query .= "VALUES($courseid, '$atype', '$description', '$dayno')";
    $conn->query($query);
} else {
    $query = "UPDATE courseactivities ";
    $query .= "SET atype = '$atype', ";
    if($atype == "Audio" && $description != ""){
        $query = "description = '$description', ";    
    }    
    $query .= "dayno = '$dayno' ";
    $query .= "WHERE id = $id";
    $conn->query($query);
}
header('Location: activities.php?courseid=' . $courseid . '&id=0');
?>
