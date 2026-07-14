<?php
require_once '../includes/functions.php';
require_once '../config/db.php';

requireLogin();

$pageTitle="Jobs";
$basePath="../";
$userId=$_SESSION['user_id'];

$result=mysqli_query($conn,"SELECT * FROM jobs WHERE user_id=$userId ORDER BY id DESC");

include '../includes/header.php';
?>

<div class="app-wrapper">

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<?php include '../includes/navbar.php'; ?>

<div class="container-fluid">

<?php showFlash(); ?>

<div class="card">

<div class="card-header d-flex justify-content-between align-items-center">

<h4 class="mb-0">My Jobs</h4>

<a href="add.php" class="btn btn-primary-custom">
<i class="bi bi-plus-circle"></i> Add Job
</a>

</div>

<div class="card-body">

<div class="row mb-3">

<div class="col-md-6">
<input type="text" id="search" class="form-control" placeholder="Search Company or Job Title...">
</div>

<div class="col-md-3">
<select id="statusFilter" class="form-select">
<option value="">All Status</option>
<option>Applied</option>
<option>Interview</option>
<option>Selected</option>
<option>Rejected</option>
</select>
</div>

</div>

<div id="jobsTable">

<table class="table table-bordered table-hover align-middle">

<thead>
<tr>
<th>Company</th>
<th>Job Title</th>
<th>Status</th>
<th>Date</th>
<th width="220">Action</th>
</tr>
</thead>

<tbody>

<?php if(mysqli_num_rows($result)>0): ?>

<?php while($job=mysqli_fetch_assoc($result)): ?>

<tr>

<td><?= htmlspecialchars($job['company_name']) ?></td>

<td><?= htmlspecialchars($job['job_title']) ?></td>

<td>
<span class="badge bg-primary">
<?= htmlspecialchars($job['status']) ?>
</span>
</td>

<td><?= htmlspecialchars($job['applied_date']) ?></td>

<td>

<a href="view.php?id=<?=$job['id']?>" class="btn btn-info btn-sm">
<i class="bi bi-eye"></i>
</a>

<a href="edit.php?id=<?=$job['id']?>" class="btn btn-warning btn-sm">
<i class="bi bi-pencil"></i>
</a>

<a href="delete.php?id=<?=$job['id']?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this job?')">
<i class="bi bi-trash"></i>
</a>

</td>

</tr>

<?php endwhile; ?>

<?php else: ?>

<tr>
<td colspan="5" class="text-center py-4">
No Jobs Found
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

<!-- <script>
$("#search").keyup(function(){
    $.get("ajax_search.php",{q:$(this).val()},function(data){
        $("#jobsTable").html(data);
    });
});

$("#statusFilter").change(function(){
    $.get("ajax_filter.php",{status:$(this).val()},function(data){
        $("#jobsTable").html(data);
    });
});
</script> -->

<?php include '../includes/footer.php'; ?>
