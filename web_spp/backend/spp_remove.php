<?php
session_start();
if ($_SESSION['level']!="admin"){
    if ($_SESSION['level']!="petugas"){
        header("location:session/index.php?msg=none");
    }
}
include 'connection.php';

$id = $_GET['id']; // backend/class_remove.php?id=$id

mysqli_query($connection,"DELETE FROM spp WHERE id_spp = '$id'");

header("location:../dashboard/spp.php");
?>