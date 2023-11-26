<?php
include 'connection.php';

// backend/class_remove.php?kelas=$kelas
$nis = $_POST['nis'];
$nama = $_POST['nama_siswa'];
$id_kelas = $_POST['id_kelas'];
$alamat = $_POST['alamat'];
$no_tlp = $_POST['no_tlp'];
$id_spp = $_POST['id_spp'];

$sql = mysqli_query($connection,"INSERT INTO siswa (nisn, nis, nama, id_kelas, alamat, no_tlp, id_spp) VALUES (NULL, '$nis', '$nama', '$id_kelas', '$alamat', '$no_tlp', '$id_spp')");

if ($sql) {
    header("location:../dashboard/students.php");
} else {
    echo mysqli_error($connection);
}

?>