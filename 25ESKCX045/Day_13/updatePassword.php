<?php

include("dashboardHeader.php");
include("checkUpdate.php");

?>

<div class="container mt-4">

<div class="row">

<?php include("dashboardVertical.php"); ?>

<div class="col-md-9">

<div class="card">

<div class="card-body">

<h3 class="mb-4">Change Password</h3>

<?php

if($message!=""){

?>

<div class="alert alert-info">

<?=$message;?>

</div>

<?php

}

?>

<form action="" method="post">

<div class="mb-3">

<label class="form-label">

Current Password

</label>

<input
type="password"
name="current_password"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

New Password

</label>

<input
type="password"
name="new_password"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Confirm Password

</label>

<input
type="password"
name="confirm_password"
class="form-control"
required>

</div>

<button
type="submit"
class="btn btn-primary">

Update Password

</button>

</form>

</div>

</div>

</div>

</div>

</div>

<?php

include("footer.php");

?>