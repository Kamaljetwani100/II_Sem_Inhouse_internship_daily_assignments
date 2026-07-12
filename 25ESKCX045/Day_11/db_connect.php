<?php

$servername="localhost";
$username="root";
$password="";
$dbname="industrial_training";

$conn=mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){

die("Database Connection Failed");

}

?>