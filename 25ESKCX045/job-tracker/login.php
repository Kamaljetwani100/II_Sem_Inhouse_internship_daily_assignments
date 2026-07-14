<?php
require_once 'includes/functions.php';
require_once 'config/db.php';

if (isLoggedIn()) {
    redirect('dashboard/index.php');
}

$errors = [];
$old = ['email' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $old['email'] = $email;

    if ($email === '' || $password === '') {
        $errors[] = "Email and password are required.";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id, name, password FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $user['password'])) {
                // Prevent session fixation
                session_regenerate_id(true);

                $_SESSION['user_id']   = $user['id'];
                $_SESSION['user_name'] = $user['name'];

                redirect('dashboard/index.php');
            } else {
                $errors[] = "Incorrect email or password.";
            }
        } else {
            $errors[] = "Incorrect email or password.";
        }
        mysqli_stmt_close($stmt);
    }
}

$pageTitle = 'Login';
include 'includes/header.php';
?>

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="brand-logo"><i class="bi bi-briefcase-fill"></i> Job Tracker</div>
            <p class="text-muted mb-0">Log in to manage your job applications</p>
        </div>

        <?php showFlash(); ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php" class="needs-validation" novalidate>
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email"
                       value="<?php echo $old['email']; ?>" required>
                <div class="invalid-feedback">Please enter your email.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                <div class="invalid-feedback">Please enter your password.</div>
            </div>

            <button type="submit" class="btn btn-primary-custom w-100 mt-2">Log In</button>
        </form>

        <p class="text-center mt-3 mb-0">
            Don't have an account? <a href="signup.php">Sign up</a>
        </p>
    </div>
</div>

<script>
(function () {
    const forms = document.querySelectorAll('.needs-validation');
    forms.forEach(function (form) {
        form.addEventListener('submit', function (e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
})();
</script>

<?php include 'includes/footer.php'; ?>
