<?php
include 'connection.php';

// backend/class_remove.php?kelas=$kelas
$kelas = $_POST['nama_kelas'];
$kk = $_POST['kompetensi_keahlian'];

$sql = mysqli_query($connection,"INSERT INTO kelas (id_kelas,nama_kelas,kompetensi_keahlian) VALUES (NULL, '$kelas', '$kk')");

if ($sql) {
    header("location:../dashboard/class.php");
} else {
    echo mysqli_error($connection);
}

?>