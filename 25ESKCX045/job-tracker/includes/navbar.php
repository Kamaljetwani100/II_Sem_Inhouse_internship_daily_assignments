<?php
// Logged in user's name
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User';
?>

<div class="topbar">

    <div class="d-flex align-items-center">

        <img src="<?php echo $basePath; ?>images/logo-job-tracker.jpg"
             alt="Job Tracker Logo"
             width="70"
             height="70"
             class="me-3">

        <div>
            <h4 class="mb-0 fw-bold">Job Application Tracker</h4>
            <small class="text-muted">Track and manage your job applications</small>
        </div>

    </div>

    <div class="d-flex align-items-center">

        <span class="me-3">
            <i class="bi bi-person-circle"></i>
            Welcome,
            <strong><?php echo htmlspecialchars($userName); ?></strong>
        </span>

        <a href="../logout.php" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </a>

    </div>

</div>