<?php
include '../backend/connection.php';

// backend/class_remove.php?kelas=$kelas
$nickname   = mysqli_real_escape_string($connection, $_POST['nickname']);
$username   = $_POST['username'];
$password   = $_POST['password'];
$email      = $_POST['email'];
$bio        = mysqli_real_escape_string($connection, $_POST['bio']);
$address    = mysqli_real_escape_string($connection, $_POST['address']);
// $picture    = $_POST['pngPicture'];


$sql = mysqli_query($connection,"INSERT INTO user (user_id,date_register,nickname,username,password,email,bio,address,level) VALUES (NULL, current_timestamp()  ,'$nickname', '$username','$password','$email','$bio','$address','basic')");

if ($sql) {
    // $sql_id = mysqli_query($connection,"SELECT * FROM user WHERE user_id = LAST_INSERT_ID()")->fetch_assoc();
    
    $acc = mysqli_query($connection,"SELECT * FROM user WHERE username = '$username'")->fetch_assoc();

    $target_file = "../assets/images/user_icon/" . $acc['user_id'] . "-" . $username . "." . pathinfo($_FILES['pngPicture']['name'],PATHINFO_EXTENSION); // Icon
    $img = move_uploaded_file($_FILES["pngPicture"]["tmp_name"], $target_file); // Upload file

    $mysql = mysqli_query($connection,"UPDATE user SET picture = '". $acc['user_id'] ."-". $acc['username'] . "." . pathinfo($_FILES['pngPicture']['name'],PATHINFO_EXTENSION) ."'  WHERE user_id = ".$acc['user_id']);;
    // $_SESSION['nickname'] = $acc['nickname'];
    // $_SESSION['username'] = $acc['username'];
    // $_SESSION['user_id'] = $acc['user_id'];
    // $_SESSION['level'] = "basic";
    // $_SESSION['status'] = "login";

    header("location:login.php?msg=registered");
} else {
    echo mysqli_error($connection);
}

?>