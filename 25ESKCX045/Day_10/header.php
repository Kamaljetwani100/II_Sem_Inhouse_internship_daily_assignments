<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Portal</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">

<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

</head>

<body>

<header>

<div class="container">

<div class="d-flex justify-content-between align-items-center py-3">

<div class="d-flex align-items-center">

<img src="logo.png" class="logo-img me-2">

<div class="logo">
<h1>Student Portal</h1>
</div>

</div>

<nav>

<ul class="nav">

<?php
if(isset($_SESSION["user_id"])){
?>

<li class="nav-item">
<a href="dashboard.php" class="nav-link">Dashboard</a>
</li>

<li class="nav-item">
<a href="logout.php" class="nav-link">Logout</a>
</li>

<?php
}else{
?>

<li class="nav-item">
<a href="registeration.php" class="nav-link">Register</a>
</li>

<li class="nav-item">
<a href="login.php" class="nav-link">Login</a>
</li>

<?php
}
?>

</ul>

</nav>

</div>

</div>

</header>