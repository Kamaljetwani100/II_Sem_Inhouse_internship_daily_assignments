<?php

include("db_connect.php");

$message="";

if(session_status()==PHP_SESSION_NONE){
session_start();
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

$current=$_POST["current_password"];
$new=$_POST["new_password"];
$confirm=$_POST["confirm_password"];

$id=$_SESSION["user_id"];

$user=mysqli_query($conn,"SELECT * FROM user WHERE id='$id'");

$data=mysqli_fetch_assoc($user);

if($current!=$data["password"]){

$message="Current password is incorrect.";

}

else if($new!=$confirm){

$message="Passwords do not match.";

}

else{

$update=mysqli_query($conn,"UPDATE user SET password='$new' WHERE id='$id'");

if($update){

$message="Password Updated Successfully.";

}

else{

$message="Unable to update password.";

}

}

}

?>