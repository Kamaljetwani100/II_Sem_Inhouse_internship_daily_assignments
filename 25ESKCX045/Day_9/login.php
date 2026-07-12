<?php

include("header.php");
include("checklogin.php");

?>

<div class="container">

<div class="form-box">

<h3>Login</h3>

<?php

if($error!=""){
?>

<div class="alert alert-danger">
<?=$error;?>
</div>

<?php
}
?>

<form action="" method="post">

<div class="mb-3">

<label class="form-label">Email</label>

<input
type="email"
name="email"
class="form-control"
placeholder="Enter Email"
value="<?=$email;?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Password</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Enter Password"
required>

</div>

<button type="submit" class="btn btn-primary">

Login

</button>

<div class="text-center mt-3">

Don't have an account?

<a href="registeration.php">

Register

</a>

</div>

</form>

</div>

</div>

<?php

include("footer.php");

?>