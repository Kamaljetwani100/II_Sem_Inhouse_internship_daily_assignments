<?php

include("header.php");

if(session_status()==PHP_SESSION_NONE){
session_start();
}

if(!isset($_SESSION["user_id"])){

header("Location: login.php");
exit();

}

?>

<div class="container mt-4">

<div class="row">

<div class="col-md-12">

<div class="card">

<div class="card-body">

<h3>

Welcome,

<?=$_SESSION["user_name"];?>

</h3>

<p class="mb-0">

You have successfully logged in.

</p>

</div>

</div>

</div>

</div>

</div>