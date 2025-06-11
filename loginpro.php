<?php
require_once 'database.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    echo $email;
    $qr = "SELECT name,email,password FROM users WHERE email = '$email'";
    $rn = mysqli_query($conn,$qr);
    if($rn){
        while($result = mysqli_fetch_array($rn)){
            $dbemail = $result['email'];
            $dbpass = $result['password'];
        }
    }
        if($email != $dbemail){
                echo "<script>alert('USER DOES NOT EXIST')</script>";
                echo "<script>location.href='login.php'</script>";
        }else{
            password_verify($dbpass,$password);
            header('location:index.php');
        }

?>