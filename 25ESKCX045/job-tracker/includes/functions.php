<?php



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}


function redirect($url) {
    header("Location: " . $url);
    exit();
}


function isLoggedIn() {
    return isset($_SESSION['user_id']);
}


function requireLogin() {
    if (!isLoggedIn()) {
        redirect('../login.php');
    }
}


function setFlash($type, $message) {
    $_SESSION['flash'][$type] = $message;
}


function showFlash() {
    if (!empty($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $type => $message) {
            $alertClass = ($type === 'success') ? 'alert-success' : 'alert-danger';
            echo '<div class="alert ' . $alertClass . ' alert-dismissible fade show" role="alert">
                    ' . htmlspecialchars($message) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>';
        }
        unset($_SESSION['flash']);
    }
}
