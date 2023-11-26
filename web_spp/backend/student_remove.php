<?php
session_start();
if ($_SESSION['level']!="admin"){
    header("location:session/index.php?msg=none");
}
include 'connection.php';

$nisn = $_GET['id']; // backend/class_remove.php?id=$id

mysqli_query($connection,"DELETE FROM siswa WHERE nisn = '$nisn'");

header("location:../dashboard/students.php");
?>