
<?php
include("../connection.php");

$json = file_get_contents('php://input');
$data = json_decode($json);

$email = $data->email;
$password = $data->password;

// $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$sql = "SELECT id, name FROM users WHERE email = '$email' AND password = '$password'";
$users = $conn->query($sql);

$tarray = array();



if ($users->num_rows == 0) {
    $tarray["status"] = 'failed';
} else {
    $user = mysqli_fetch_assoc($users);
    $tarray["status"] = 'success';
    $tarray["id"] = $user["id"];
    $tarray["name"] = $user["name"];
    
}

header('Content-Type: application/json');
echo json_encode($tarray);
?>
