<?php
require_once '../includes/functions.php';
require_once '../config/db.php';

requireLogin();

$userId = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    setFlash('error','Invalid request.');
    redirect('index.php');
}

$id = (int)$_GET['id'];

$stmt = mysqli_prepare($conn,"DELETE FROM jobs WHERE id=? AND user_id=?");
mysqli_stmt_bind_param($stmt,"ii",$id,$userId);

if(mysqli_stmt_execute($stmt)){
    if(mysqli_stmt_affected_rows($stmt)>0){
        setFlash('success','Job deleted successfully.');
    }else{
        setFlash('error','Job not found.');
    }
}else{
    setFlash('error','Unable to delete job.');
}

mysqli_stmt_close($stmt);

redirect('index.php');
?>