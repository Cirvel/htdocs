<?php
include 'connection.php';

// backend/class_remove.php?kelas=$kelas
$tahun = $_POST['tahun'];
$nominal = $_POST['nominal'];

$sql = mysqli_query($connection,"INSERT INTO spp (id_spp,tahun,nominal) VALUES (NULL, '$tahun','$nominal')");

if ($sql) {
    header("location:../dashboard/spp.php");
} else {
    echo mysqli_error($connection);
}

?>