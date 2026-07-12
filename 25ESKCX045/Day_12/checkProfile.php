<?php

include("db_connect.php");

$message="";

if(session_status()==PHP_SESSION_NONE){
session_start();
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

$username=mysqli_real_escape_string($conn,$_POST["username"]);
$email=mysqli_real_escape_string($conn,$_POST["email"]);

$id=$_SESSION["user_id"];

$update=mysqli_query($conn,"UPDATE user SET username='$username',email='$email' WHERE id='$id'");

if($update){

$_SESSION["user_name"]=$username;
$_SESSION["user_email"]=$email;

$message="Profile Updated Successfully.";

}

else{

$message="Something went wrong.";

}

}

?>