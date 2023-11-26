<?php
include 'connection.php';

$user    = $_POST['user'];
$mod     = $_POST['mod'];
$content = mysqli_real_escape_string($connection, $_POST['comment']);

$sql = mysqli_query($connection,"INSERT INTO comment (comment_id, user_id, mod_id, content,date_posted) VALUES (NULL, $user, $mod, '$content', current_timestamp())");

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>