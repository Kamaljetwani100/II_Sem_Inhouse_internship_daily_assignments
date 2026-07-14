<?php
require_once '../includes/functions.php';
require_once '../config/db.php';

requireLogin();

$userId=$_SESSION['user_id'];
$status=trim($_GET['status'] ?? '');

if($status==""){
    $stmt=mysqli_prepare($conn,"SELECT * FROM jobs WHERE user_id=? ORDER BY id DESC");
    mysqli_stmt_bind_param($stmt,"i",$userId);
}else{
    $stmt=mysqli_prepare($conn,"SELECT * FROM jobs WHERE user_id=? AND status=? ORDER BY id DESC");
    mysqli_stmt_bind_param($stmt,"is",$userId,$status);
}

mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
?>

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

<a href="view.php?id=<?= $job['id'] ?>" class="btn btn-info btn-sm">
<i class="bi bi-eye"></i>
</a>

<a href="edit.php?id=<?= $job['id'] ?>" class="btn btn-warning btn-sm">
<i class="bi bi-pencil"></i>
</a>

<a href="delete.php?id=<?= $job['id'] ?>"
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
