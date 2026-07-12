<?php

include("header.php");
include("checkRegisteration.php");

?>

<div class="container">

<div class="form-box">

<h3>Register</h3>

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

<label class="form-label">Username</label>

<input
type="text"
name="username"
class="form-control"
placeholder="Enter Username"
value="<?=$name;?>"
required>

</div>

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

<div class="mb-3">

<label class="form-label">Confirm Password</label>

<input
type="password"
name="confirm_password"
class="form-control"
placeholder="Confirm Password"
required>

</div>

<button type="submit" class="btn btn-primary">

Create Account

</button>

<div class="text-center mt-3">

Already have an account?

<a href="login.php">

Login

</a>

</div>

</form>

</div>

</div>

<?php

include("footer.php");

?>