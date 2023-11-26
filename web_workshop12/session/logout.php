<?php 
session_start();

session_destroy();

// header("location:javascript://history.go(-1)");
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;

// header("location:login.php?msg=logout");
?>