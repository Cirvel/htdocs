<?php
include 'connection.php';

$id = $_POST['genre_id'];
$genre_name = $_POST['title'];
$genre_desc = $_POST['description'];

$sql = mysqli_query($connection, "UPDATE genre SET genre_name = '$genre_name', genre_desc = '$genre_desc' WHERE genre_id = $id");

if (isset($_POST["admin"])) {
    header('location:../dashboard/genre_list.php');
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
exit;
?>