<?php
    include("../connection.php");   

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $name = $data->name;
    $mobileno = $data->mobile;
    $email = $data->email;
    $password = $data->password;
    
    $sql = "INSERT INTO users(name,  mobileno, email, password) ";
    $sql .= "VALUES ('$name' , '$mobileno','$email', '$password')";
    $conn->query($sql);       
    $tarray = array();
    $tarray["status"] = 'success';
  
    header('Content-Type: application/json');
	echo json_encode($tarray);
    
?>