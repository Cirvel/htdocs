<?php
include 'connection.php';

// backend/class_remove.php?kelas=$kelas
$id = $_POST['nisn'];
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$id_kelas = $_POST['id_kelas'];
$alamat = $_POST['alamat'];
$no_tlp = $_POST['no_tlp'];
$id_spp = $_POST['id_spp'];

$sql = mysqli_query($connection,"UPDATE siswa SET nis = '$nis', nama = '$nama', id_kelas = '$id_kelas', alamat = '$alamat', no_tlp = '$no_tlp', id_spp = '$id_spp' WHERE nisn = $id");

if ($sql) {
    header("location:../dashboard/students.php");
} else {
    echo mysqli_error($connection);
}
?>