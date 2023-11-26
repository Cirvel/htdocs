<?php
include 'connection.php';

// backend/class_remove.php?kelas=$kelas
$nama_petugas = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

$sql = mysqli_query($connection,"INSERT INTO petugas (id_petugas, nama_petugas, username, password, level) VALUES (NULL, '$nama_petugas', '$username', '$password', '$level')");

if ($sql) {
    header("location:../dashboard/employee.php");
} else {
    echo mysqli_error($connection);
}

?>