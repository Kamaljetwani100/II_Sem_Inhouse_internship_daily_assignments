<?php
require_once '../includes/functions.php';
require_once '../config/db.php';

requireLogin();

$pageTitle = "Edit Job";
$basePath = "../";

$userId = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    redirect('index.php');
}

$id = (int)$_GET['id'];

$stmt = mysqli_prepare($conn,"SELECT * FROM jobs WHERE id=? AND user_id=?");
mysqli_stmt_bind_param($stmt,"ii",$id,$userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result)==0){
    redirect('index.php');
}

$job = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

$errors=[];

if($_SERVER['REQUEST_METHOD']=="POST"){

    $company=sanitize($_POST['company_name']);
    $title=sanitize($_POST['job_title']);
    $location=sanitize($_POST['location']);
    $salary=sanitize($_POST['salary']);
    $date=$_POST['applied_date'];

    if ($date > date('Y-m-d')) {
    $errors[] = "Applied date cannot be in the future.";
    }

    $status=sanitize($_POST['status']);
    $notes=sanitize($_POST['notes']);
    $link=sanitize($_POST['job_link']);

    if($company==''||$title==''||$date==''||$status==''){
        $errors[]="Please fill all required fields.";
    }

    if(empty($errors)){
        $stmt=mysqli_prepare($conn,"UPDATE jobs SET company_name=?,job_title=?,location=?,salary=?,applied_date=?,status=?,notes=?,job_link=? WHERE id=? AND user_id=?");
        mysqli_stmt_bind_param($stmt,"ssssssssii",$company,$title,$location,$salary,$date,$status,$notes,$link,$id,$userId);

        if(mysqli_stmt_execute($stmt)){
            setFlash('success','Job updated successfully.');
            redirect('index.php');
        }else{
            $errors[]="Unable to update job.";
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

<div class="card">
<div class="card-header">
<h4>Edit Job</h4>
</div>

<div class="card-body">

<?php if($errors): ?>
<div class="alert alert-danger"><ul>
<?php foreach($errors as $e): ?>
<li><?=htmlspecialchars($e)?></li>
<?php endforeach; ?>
</ul></div>
<?php endif; ?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">
<label>Company Name</label>
<input class="form-control" name="company_name" value="<?=htmlspecialchars($job['company_name'])?>" required>
</div>

<div class="col-md-6 mb-3">
<label>Job Title</label>
<input class="form-control" name="job_title" value="<?=htmlspecialchars($job['job_title'])?>" required>
</div>

<div class="col-md-6 mb-3">
<label>Location</label>
<input class="form-control" name="location" value="<?=htmlspecialchars($job['location'])?>">
</div>

<div class="col-md-6 mb-3">
<label>Salary</label>
<input class="form-control" name="salary" value="<?=htmlspecialchars($job['salary'])?>">
</div>

<div class="col-md-6 mb-3">
<label>Applied Date</label>
<input type="date"
       class="form-control"
       name="applied_date"
       value="<?= htmlspecialchars($job['applied_date']) ?>"
       max="<?= date('Y-m-d') ?>"
       required>
</div>

<div class="col-md-6 mb-3">
<label>Status</label>
<select class="form-select" name="status">
<?php
$statusList=['Applied','Interview','Selected','Rejected'];
foreach($statusList as $s){
$sel=$job['status']==$s?'selected':'';
echo "<option $sel>$s</option>";
}
?>
</select>
</div>

<div class="col-12 mb-3">
<label>Job Link</label>
<input class="form-control" name="job_link" value="<?=htmlspecialchars($job['job_link'])?>">
</div>

<div class="col-12 mb-3">
<label>Notes</label>
<textarea class="form-control" rows="4" name="notes"><?=htmlspecialchars($job['notes'])?></textarea>
</div>

</div>

<button class="btn btn-primary-custom">
<i class="bi bi-check-circle"></i> Update Job
</button>

<a href="index.php" class="btn btn-secondary">Cancel</a>

</form>

</div>
</div>

</div>
</div>

<?php include '../includes/footer.php'; ?>
