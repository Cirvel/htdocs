<?php
session_start();
if ($_SESSION['level']!="admin"){
    header("location:session/index.php?msg=none");
}
include 'connection.php';

$id = $_GET['id']; // backend/class_remove.php?id=$id

mysqli_query($connection,"DELETE FROM kelas WHERE id_kelas = '$id'");

header("location:../dashboard/class.php");
?>