<?php
require_once '../includes/functions.php';
require_once '../config/db.php';

requireLogin();

$pageTitle = "Add Job";
$basePath = "../";

$userId = $_SESSION['user_id'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $company = sanitize($_POST['company_name'] ?? '');
    $title   = sanitize($_POST['job_title'] ?? '');
    $location = sanitize($_POST['location'] ?? '');
    $salary  = sanitize($_POST['salary'] ?? '');
    $date    = $_POST['applied_date'] ?? '';

    if ($date > date('Y-m-d')) {
    $errors[] = "Applied date cannot be in the future.";
    }

    $status  = sanitize($_POST['status'] ?? '');
    $notes   = sanitize($_POST['notes'] ?? '');
    $link    = sanitize($_POST['job_link'] ?? '');

    if($company=='' || $title=='' || $date=='' || $status==''){
        $errors[]="Please fill all required fields.";
    }

    if(empty($errors)){
        $stmt = mysqli_prepare($conn,
        "INSERT INTO jobs
        (user_id,company_name,job_title,location,salary,applied_date,status,notes,job_link)
        VALUES(?,?,?,?,?,?,?,?,?)");

        mysqli_stmt_bind_param(
            $stmt,
            "issssssss",
            $userId,
            $company,
            $title,
            $location,
            $salary,
            $date,
            $status,
            $notes,
            $link
        );

        if(mysqli_stmt_execute($stmt)){
            setFlash('success','Job added successfully.');
            redirect('index.php');
        }else{
            $errors[]="Unable to add job.";
        }

        mysqli_stmt_close($stmt);
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
<h4>Add Job</h4>
</div>

<div class="card-body">

<?php if(!empty($errors)): ?>
<div class="alert alert-danger">
<ul class="mb-0">
<?php foreach($errors as $e): ?>
<li><?= htmlspecialchars($e) ?></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">
<label class="form-label">Company Name *</label>
<input type="text" name="company_name" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Job Title *</label>
<input type="text" name="job_title" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Location</label>
<input type="text" name="location" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Salary</label>
<input type="text" name="salary" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Applied Date *</label>
<input type="date"
       name="applied_date"
       class="form-control"
       max="<?= date('Y-m-d') ?>"
       required>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Status *</label>
<select name="status" class="form-select" required>
<option value="">Select</option>
<option>Applied</option>
<option>Interview</option>
<option>Selected</option>
<option>Rejected</option>
</select>
</div>

<div class="col-12 mb-3">
<label class="form-label">Job Link</label>
<input type="url" name="job_link" class="form-control">
</div>

<div class="col-12 mb-3">
<label class="form-label">Notes</label>
<textarea name="notes" rows="4" class="form-control"></textarea>
</div>

</div>

<button class="btn btn-primary-custom">
<i class="bi bi-plus-circle"></i> Save Job
</button>

<a href="index.php" class="btn btn-secondary">
Cancel
</a>

</form>

</div>
</div>

</div>

</div>

<?php include '../includes/footer.php'; ?>
