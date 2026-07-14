<?php
require_once '../includes/functions.php';
require_once '../config/db.php';

requireLogin();

$pageTitle="Profile";
$basePath="../";

$userId=$_SESSION['user_id'];
$errors=[];

$stmt=mysqli_prepare($conn,"SELECT name,email FROM users WHERE id=?");
mysqli_stmt_bind_param($stmt,"i",$userId);
mysqli_stmt_execute($stmt);
$user=mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if($_SERVER['REQUEST_METHOD']=="POST"){

$name=sanitize($_POST['name']);
$password=$_POST['password'] ?? "";
$confirm=$_POST['confirm_password'] ?? "";

if($name=="") $errors[]="Name is required.";

if(empty($errors)){
    $stmt=mysqli_prepare($conn,"UPDATE users SET name=? WHERE id=?");
    mysqli_stmt_bind_param($stmt,"si",$name,$userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $_SESSION['user_name']=$name;

    if($password!=""){
        if(strlen($password)<6){
            $errors[]="Password must be at least 6 characters.";
        }elseif($password!=$confirm){
            $errors[]="Passwords do not match.";
        }else{
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $stmt=mysqli_prepare($conn,"UPDATE users SET password=? WHERE id=?");
            mysqli_stmt_bind_param($stmt,"si",$hash,$userId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    if(empty($errors)){
        setFlash('success','Profile updated successfully.');
        redirect('index.php');
    }
}

}

include '../includes/header.php';
?>

<div class="app-wrapper">
<?php include '../includes/sidebar.php'; ?>
<div class="main-content">
<?php include '../includes/navbar.php'; ?>

<div class="container-fluid">

<?php showFlash(); ?>

<div class="card">
<div class="card-header">
<h4>My Profile</h4>
</div>

<div class="card-body">

<?php if($errors): ?>
<div class="alert alert-danger"><ul>
<?php foreach($errors as $e): ?>
<li><?=htmlspecialchars($e)?></li>
<?php endforeach;?>
</ul></div>
<?php endif;?>

<form method="POST">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control"
value="<?=htmlspecialchars($user['name'])?>" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" class="form-control"
value="<?=htmlspecialchars($user['email'])?>" readonly>
</div>

<hr>

<h5>Change Password (Optional)</h5>

<div class="mb-3">
<label>New Password</label>
<input type="password" name="password" class="form-control">
</div>

<div class="mb-3">
<label>Confirm Password</label>
<input type="password" name="confirm_password" class="form-control">
</div>

<button class="btn btn-primary-custom">
<i class="bi bi-check-circle"></i> Save Changes
</button>

</form>

</div>
</div>

</div>
</div>

<?php include '../includes/footer.php'; ?>
