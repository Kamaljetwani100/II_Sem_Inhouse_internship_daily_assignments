<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">

    <h2 class="text-white text-center fw-bold py-4 mb-4">
        Job Tracker
    </h2>

    <div class="mt-3">

        <a href="../dashboard/index.php"
           class="nav-link <?php echo ($currentPage == 'index.php' && strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false) ? 'active' : ''; ?>">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="../jobs/index.php"
           class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'jobs') !== false) ? 'active' : ''; ?>">
            <i class="bi bi-briefcase"></i>
            Jobs
        </a>

        <a href="../profile/index.php"
           class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'profile') !== false) ? 'active' : ''; ?>">
            <i class="bi bi-person"></i>
            Profile
        </a>

        <hr class="text-light">

        <a href="../logout.php" class="nav-link">
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </a>

    </div>

</div>