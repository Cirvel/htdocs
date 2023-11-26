<?php
include 'connection.php';

// backend/class_remove.php?kelas=$kelas
$id = $_POST['id'];
$tahun = $_POST['tahun'];
$nominal = $_POST['nominal'];

$sql = mysqli_query($connection,"UPDATE spp SET tahun = '$tahun', nominal = '$nominal' WHERE id_spp = '$id'");

if ($sql) {
    header("location:../dashboard/spp.php");
} else {
    echo mysqli_error($connection);
}

?>