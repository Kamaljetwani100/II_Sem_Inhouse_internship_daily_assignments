<?php

include("db_connect.php");

$error="";

$email="";
$password="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

$email=mysqli_real_escape_string($conn,$_POST["email"]);
$password=mysqli_real_escape_string($conn,$_POST["password"]);

if($email=="" || $password==""){

$error="Please fill all fields.";

}
else{

$select=mysqli_query($conn,"SELECT * FROM user WHERE email='$email' AND password='$password'");

if(mysqli_num_rows($select)>0){

$user=mysqli_fetch_assoc($select);

if(session_status()==PHP_SESSION_NONE){
session_start();
}

$_SESSION["user_id"]=$user["id"];
$_SESSION["user_name"]=$user["username"];
$_SESSION["user_email"]=$user["email"];

header("Location: dashboard.php");
exit();

}
else{

$error="Invalid email or password.";

}

}

}

?>