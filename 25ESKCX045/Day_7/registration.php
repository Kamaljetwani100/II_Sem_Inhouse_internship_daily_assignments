<?php

// Basic form handling and validation example
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skit";
$conn=mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
die("connection failed:".mysqli_connect_error());
}echo "connection successful";

$name = $_GET['name'] ?? '';
$email = $_GET['email'] ?? '';  
$dob = $_COOKIE['dob'] ?? '';
$errors = [];
$success = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$dob = trim($_POST['dob'] ?? '');
$gender = trim($_POST['gender'] ?? '');
// Name: required only
if ($name === '') {
 $errors['name'] = 'Name is required.';
 echo "Name is required.<br>";
}
 // Email: required only
 if ($email === '') {
$errors['email'] = 'Email is required.';
 echo "Email is required.<br>";
}
// Phone: required only
if ($phone === '') {  
    $errors['phone'] = 'Phone number is required.';
    echo "Phone number is required.<br>";
}
//dob: required only
if ($dob === '') {
    $errors['dob'] = 'Date of birth is required.';
    echo "Date of birth is required.<br>";
}



if (empty($errors)) {
$success = 'Form submitted successfully.';
// Further processing (save to DB, send email, etc.) goes here
}
}
$sql="INSERT INTO `skit` (`sn`, `name`, `email`, `phone`, `dob`, `gender`, `Time`) VALUES (NULL, '$name', '$email', '$phone', '$dob', '$gender', current_timestamp())";
if(mysqli_query($conn, $sql)){
    echo "New recoRd";
}else{
    echo "ERROR".$sql. "<br>".mysqli_error($conn);
}
?>