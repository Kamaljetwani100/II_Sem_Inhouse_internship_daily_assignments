<?php

include("db_connect.php");

$error="";

$name="";
$email="";
$password="";
$confirm_password="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

$name=mysqli_real_escape_string($conn,$_POST["username"]);
$email=mysqli_real_escape_string($conn,$_POST["email"]);
$password=mysqli_real_escape_string($conn,$_POST["password"]);
$confirm_password=mysqli_real_escape_string($conn,$_POST["confirm_password"]);

if($name=="" || $email=="" || $password=="" || $confirm_password==""){

$error="All fields are required.";

}
else if($password!=$confirm_password){

$error="Passwords do not match.";

}
else{

$check=mysqli_query($conn,"SELECT * FROM user WHERE email='$email'");

if(mysqli_num_rows($check)>0){

$error="Email already exists.";

}
else{

$insert=mysqli_query($conn,"INSERT INTO user(username,email,password,current_time) VALUES('$name','$email','$password',CURRENT_TIMESTAMP)");

if($insert){

header("Location: login.php");
exit();

}
else{

$error="Registration failed.";

}

}

}

}

?>