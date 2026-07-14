<?php
require_once '../includes/functions.php';
require_once '../config/db.php';

requireLogin();

$pageTitle = "Dashboard";
$basePath = "../";

$userId = $_SESSION['user_id'];

// Total Jobs
$totalQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM jobs WHERE user_id = $userId");
$total = mysqli_fetch_assoc($totalQuery)['total'];

// Applied
$appliedQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM jobs WHERE user_id = $userId AND status='Applied'");
$applied = mysqli_fetch_assoc($appliedQuery)['total'];

// Interview
$interviewQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM jobs WHERE user_id = $userId AND status='Interview'");
$interview = mysqli_fetch_assoc($interviewQuery)['total'];

// Selected
$selectedQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM jobs WHERE user_id = $userId AND status='Selected'");
$selected = mysqli_fetch_assoc($selectedQuery)['total'];

// Rejected
$rejectedQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM jobs WHERE user_id = $userId AND status='Rejected'");
$rejected = mysqli_fetch_assoc($rejectedQuery)['total'];

include '../includes/header.php';
?>

<div class="app-wrapper">

    <?php include '../includes/sidebar.php'; ?>

    <div class="main-content">

        <?php include '../includes/navbar.php'; ?>

        <div class="container-fluid">

            <div class="row g-4">

                <div class="col-md-4 col-lg-3">
                    <div class="stat-card total">
                        <h6>Total Applications</h6>
                        <div class="stat-number">
                            <?php echo $total; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3">
                    <div class="stat-card applied">
                        <h6>Applied</h6>
                        <div class="stat-number">
                            <?php echo $applied; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3">
                    <div class="stat-card interview">
                        <h6>Interview</h6>
                        <div class="stat-number">
                            <?php echo $interview; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3">
                    <div class="stat-card selected">
                        <h6>Selected</h6>
                        <div class="stat-number">
                            <?php echo $selected; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3">
                    <div class="stat-card rejected">
                        <h6>Rejected</h6>
                        <div class="stat-number">
                            <?php echo $rejected; ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card mt-5">

                <div class="card-body text-center py-5">

                    <i class="bi bi-briefcase display-3 text-primary"></i>

                    <h3 class="mt-3">
                        Welcome,
                        <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </h3>

                    <p class="text-muted">
                        Your Job Application Tracker Dashboard is ready.
                    </p>

                    <a href="../jobs/index.php" class="btn btn-primary-custom mt-2">
                        <i class="bi bi-plus-circle"></i>
                        Manage Jobs
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>