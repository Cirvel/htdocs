<?php
include 'connection.php';

$id = $_POST['comment_id'];
$content = mysqli_real_escape_string($connection, $_POST['content']);

$sql = mysqli_query($connection, "UPDATE comment SET content = '$content' WHERE comment_id = $id");

if (isset($_POST["admin"])) {
    header('location:../dashboard/comment_list.php');
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
exit;
?>