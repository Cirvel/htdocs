<?php
include 'connection.php';

$genre_name = mysqli_real_escape_string($connection, $_POST['title']);
$genre_desc = mysqli_real_escape_string($connection, $_POST['description']);

$sql = mysqli_query($connection, "INSERT INTO genre (genre_name, genre_desc) VALUES ('$genre_name','$genre_desc')");

if (isset($_POST["admin"])) {
    header('location:../dashboard/genre_list.php');
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

exit;
?>