<?php
session_start();

include ("connection.php");

$sender = $_SESSION['id'];
$title = mysqli_real_escape_string($connection, $_POST['title']);
$content = mysqli_real_escape_string($connection, $_POST['content']);
$post_type = $_POST['post_type'];

$sql = mysqli_query($connection,"INSERT INTO admin_contact (contact_id, user_id, title, post_type, content, date_posted) VALUES (NULL, $sender, '$title', '$post_type', '$content', current_timestamp())");

header("Location: ../contact.php?msg=success");
?>