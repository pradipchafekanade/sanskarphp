<?php
include("../connection.php");
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$mobileno = $_POST['mobileno'];
$password = $_POST['password'];
$registration = $_POST['registration'];

if ($id == 0) {
    $query = "INSERT INTO users (name,email,mobileno,password,registration) VALUES('$name', '$email', '$mobileno','$password','$registration')";
    $conn->query($query);
} else {
    $query = "UPDATE users SET name = '$name', email='$email', mobileno='$mobileno', password='$password', registration='$registration' WHERE id = $id";
    $conn->query($query);
}

header('Location: users.php');

?>