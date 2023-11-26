<?php
include 'connection.php';

// backend/class_remove.php?kelas=$kelas
$id = $_POST['id'];
$id_petugas = $_POST['petugas'];
$nisn = $_POST['nisn'];
$tgl_bayar = $_POST['date'];
$bulan_dibayar = $_POST['bulan_dibayar'];
$tahun_dibayar = $_POST['tahun_dibayar'];
$jumlah_bayar = $_POST['jumlah_bayar'];

$data = mysqli_query($connection,"SELECT * FROM siswa WHERE nisn = $nisn");
$fetchy = $data->fetch_assoc();
$id_spp = $fetchy["id_spp"];

$sql = mysqli_query($connection,"UPDATE pembayaran SET id_petugas = '$id_petugas', nisn = '$nisn', tgl_bayar = '$tgl_bayar', bulan_dibayar = '$bulan_dibayar', tahun_dibayar = '$tahun_dibayar', jumlah_bayar = '$jumlah_bayar', id_spp = '$id_spp' WHERE id_pembayaran = '$id'");

if ($sql) {
    header("location:../dashboard/payment.php");
} else {
    echo mysqli_error($connection);
}
?>