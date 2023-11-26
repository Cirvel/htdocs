<?php
include 'connection.php';

// backend/class_remove.php?kelas=$kelas
$id = $_POST['id_petugas'];
$nama_petugas = $_POST['nama_petugas'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

$sql = mysqli_query($connection,"UPDATE petugas SET nama_petugas = '$nama_petugas', username = '$username', password = '$password', level = '$level' WHERE id_petugas = $id");

if ($sql) {
    header("location:../dashboard/employee.php");
} else {
    echo mysqli_error($connection);
}
?>