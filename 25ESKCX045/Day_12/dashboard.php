<?php

include("dashboardHeader.php");

?>

<div class="container mt-4">

<div class="row">

<div class="col-md-4">

<div class="card mb-3">

<div class="card-body">

<h5>User Name</h5>

<p><?=$_SESSION["user_name"];?></p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card mb-3">

<div class="card-body">

<h5>Email</h5>

<p><?=$_SESSION["user_email"];?></p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card mb-3">

<div class="card-body">

<h5>Status</h5>

<p class="text-success">Active</p>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-md-12">

<div class="card">

<div class="card-body">

<h4>Dashboard</h4>

<p>

Welcome to your dashboard. You have successfully logged in to the Student Portal.

</p>

<a href="updateProfile.php" class="btn btn-primary">

Update Profile

</a>

<a href="updatePassword.php" class="btn btn-warning ms-2">

Change Password

</a>

<a href="logout.php" class="btn btn-danger ms-2">

Logout

</a>

</div>

</div>

</div>

</div>

</div>

<?php

include("footer.php");

?>