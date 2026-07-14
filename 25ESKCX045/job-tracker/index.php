<?php
require_once 'includes/functions.php';

if (isLoggedIn()) {
    redirect('dashboard/index.php');
} else {
    redirect('login.php');
}
