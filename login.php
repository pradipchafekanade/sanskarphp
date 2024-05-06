<?php 

include('connection.php');

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    
    $query = "SELECT * FROM admins WHERE email = '$email' AND password='$password'";

    $result = $conn->query($query);

    $row =  $result->fetch_assoc();
    
    if(count($row)>0)
    {
        header('Location: admin/dashboard.php');
        // echo "success";
    }

else{
    
header('Location: index.php');
}
?>
