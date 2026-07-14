<?php
require_once 'includes/functions.php';
require_once 'config/db.php';

// If already logged in, go straight to dashboard
if (isLoggedIn()) {
    redirect('dashboard/index.php');
}

$errors = [];
$old = ['name' => '', 'email' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name            = sanitize($_POST['name'] ?? '');
    $email           = sanitize($_POST['email'] ?? '');
    $password        = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    $old['name']  = $name;
    $old['email'] = $email;

    // ---------------- Backend Validation ----------------
    if ($name === '') {
        $errors[] = "Full name is required.";
    }

    if ($email === '') {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if ($password === '') {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Password and Confirm Password do not match.";
    }

    // Check if email already exists (only if no earlier errors, to save a query)
    if (empty($errors)) {
        $checkStmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($checkStmt, "s", $email);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            $errors[] = "An account with this email already exists.";
        }
        mysqli_stmt_close($checkStmt);
    }

    // ---------------- Insert User ----------------
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertStmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($insertStmt, "sss", $name, $email, $hashedPassword);

        if (mysqli_stmt_execute($insertStmt)) {
            setFlash('success', 'Account created successfully! Please log in.');
            redirect('login.php');
        } else {
            $errors[] = "Something went wrong. Please try again.";
        }
        mysqli_stmt_close($insertStmt);
    }
}

$pageTitle = 'Sign Up';
include 'includes/header.php';
?>

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="brand-logo"><i class="bi bi-briefcase-fill"></i> Job Tracker</div>
            <p class="text-muted mb-0">Create your account to get started</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="signup.php" id="signupForm" novalidate>
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your full name"
                       value="<?php echo $old['name']; ?>" required>
                <div class="invalid-feedback">Please enter your full name.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email"
                       value="<?php echo $old['email']; ?>" required>
                <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="At least 6 characters"
                       minlength="6" required>
                <div class="invalid-feedback">Password must be at least 6 characters.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Re-enter password"
                       minlength="6" required>
                <div class="invalid-feedback">Passwords must match.</div>
            </div>

            <button type="submit" class="btn btn-primary-custom w-100 mt-2">Create Account</button>
        </form>

        <p class="text-center mt-3 mb-0">
            Already have an account? <a href="login.php">Log in</a>
        </p>
    </div>
</div>

<script>
// ---------------- Frontend Validation ----------------
(function () {
    const form = document.getElementById('signupForm');

    form.addEventListener('submit', function (e) {
        let valid = true;

        const password = form.querySelector('[name="password"]');
        const confirm   = form.querySelector('[name="confirm_password"]');

        // Reset custom validity
        confirm.setCustomValidity('');

        if (password.value !== confirm.value) {
            confirm.setCustomValidity('Passwords do not match.');
            valid = false;
        }

        if (!form.checkValidity() || !valid) {
            e.preventDefault();
            e.stopPropagation();
        }

        form.classList.add('was-validated');
    });
})();
</script>

<?php include 'includes/footer.php'; ?>
