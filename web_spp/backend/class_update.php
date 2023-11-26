<?php
include 'connection.php';

// backend/class_remove.php?kelas=$kelas
$id = $_POST['id_kelas'];
$kelas = $_POST['nama_kelas'];
$kk = $_POST['kompetensi_keahlian'];

$sql = mysqli_query($connection,"UPDATE kelas SET nama_kelas = '$kelas', kompetensi_keahlian = '$kk' WHERE id_kelas = '$id'");

if ($sql) {
    header("location:../dashboard/class.php");
} else {
    echo mysqli_error($connection);
}

?>