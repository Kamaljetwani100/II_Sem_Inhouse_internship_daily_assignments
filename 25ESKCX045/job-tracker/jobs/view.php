<?php
require_once '../includes/functions.php';
require_once '../config/db.php';

requireLogin();

$pageTitle = "View Job";
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
    setFlash('error','Job not found.');
    redirect('index.php');
}

$job = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

include '../includes/header.php';
?>

<div class="app-wrapper">

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<?php include '../includes/navbar.php'; ?>

<div class="container-fluid">

<div class="card">

<div class="card-header d-flex justify-content-between">
    <h4>Job Details</h4>
    <a href="index.php" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="card-body">

<table class="table table-bordered">

<tr>
<th width="25%">Company</th>
<td><?= htmlspecialchars($job['company_name']) ?></td>
</tr>

<tr>
<th>Job Title</th>
<td><?= htmlspecialchars($job['job_title']) ?></td>
</tr>

<tr>
<th>Location</th>
<td><?= htmlspecialchars($job['location']) ?></td>
</tr>

<tr>
<th>Salary</th>
<td><?= htmlspecialchars($job['salary']) ?></td>
</tr>

<tr>
<th>Applied Date</th>
<td><?= htmlspecialchars($job['applied_date']) ?></td>
</tr>

<tr>
<th>Status</th>
<td>
<span class="badge bg-primary">
<?= htmlspecialchars($job['status']) ?>
</span>
</td>
</tr>

<tr>
<th>Job Link</th>
<td>
<?php if(!empty($job['job_link'])): ?>
<a href="<?= htmlspecialchars($job['job_link']) ?>" target="_blank">
<?= htmlspecialchars($job['job_link']) ?>
</a>
<?php else: ?>
-
<?php endif; ?>
</td>
</tr>

<tr>
<th>Notes</th>
<td><?= nl2br(htmlspecialchars($job['notes'])) ?></td>
</tr>

</table>

<div class="mt-3">

<a href="edit.php?id=<?= $job['id'] ?>" class="btn btn-warning">
<i class="bi bi-pencil-square"></i> Edit
</a>

<a href="delete.php?id=<?= $job['id'] ?>"
class="btn btn-danger"
onclick="return confirm('Delete this job?')">
<i class="bi bi-trash"></i> Delete
</a>

</div>

</div>

</div>

</div>

</div>

<?php include '../includes/footer.php'; ?>
