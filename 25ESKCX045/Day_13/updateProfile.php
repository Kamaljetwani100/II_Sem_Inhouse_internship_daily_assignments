<?php

include("dashboardHeader.php");
include("checkProfile.php");

?>

<div class="container mt-4">

<div class="row">

<?php include("dashboardVertical.php"); ?>

<div class="col-md-9">

<div class="card">

<div class="card-body">

<h3 class="mb-4">Update Profile</h3>

<?php

if($message!=""){

?>

<div class="alert alert-success">

<?=$message;?>

</div>

<?php

}

?>

<form action="" method="post">

<div class="mb-3">

<label class="form-label">

Username

</label>

<input
type="text"
name="username"
class="form-control"
value="<?=$_SESSION["user_name"];?>"
required>

</div>

<div class="mb-3">

<label class="form-label">

Email

</label>

<input
type="email"
name="email"
class="form-control"
value="<?=$_SESSION["user_email"];?>"
required>

</div>

<button
class="btn btn-primary"
type="submit">

Update Profile

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