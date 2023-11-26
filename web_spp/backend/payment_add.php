<?php
include 'connection.php';

session_start();

// backend/class_remove.php?kelas=$kelas
$id_petugas = $_POST['petugas'];
// $id_petugas = $_SESSION['id'];
$nisn = $_POST['nisn'];
$tgl_bayar = $_POST['date'];
$bulan_dibayar = $_POST['bulan_dibayar'];
$tahun_dibayar = $_POST['tahun_dibayar'];
$jumlah_bayar = $_POST['jumlah_bayar'];

$data = mysqli_query($connection,"SELECT * FROM siswa WHERE nisn = $nisn");
$fetchy = $data->fetch_assoc();
$id_spp = $fetchy["id_spp"];

$sql = mysqli_query($connection,"INSERT INTO pembayaran (id_pembayaran ,id_petugas, nisn, tgl_bayar, bulan_dibayar, tahun_dibayar, id_spp, jumlah_bayar)
VALUES (NULL, '$id_petugas', '$nisn', '$tgl_bayar', '$bulan_dibayar', '$tahun_dibayar','$id_spp', '$jumlah_bayar')");

if ($sql) {
    header("location:../dashboard/payment.php");
} else {
    echo mysqli_error($connection);
}

?>