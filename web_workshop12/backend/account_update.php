<?php
session_start();
include 'connection.php';

$uploadOk = 1; // The green light for uploading mod

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["pngPicture"]["tmp_name"]); // Get file size for icon

    if ($check) { // Check if picture isnt not an image
        $uploadOk = 1;
        if ($_FILES["pngPicture"] ["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    }
}

if ($uploadOk == 1) { // If the mod passed the file check, upload
    $user_id    = $_SESSION['id'];
    $user       = $_POST['user_id'];
    $nickname   = mysqli_real_escape_string($connection, $_POST['nickname']);
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $email      = $_POST['email'];
    $bio        = mysqli_real_escape_string($connection, $_POST['bio']);
    $address    = mysqli_real_escape_string($connection, $_POST['address']);
    $level      = "basic";
    if(isset($_POST['level'])) {
        $level = $_POST['level'];
    }
    
    $target_file = "../assets/images/user_icon/". $user . "-". $username . "." . pathinfo($_FILES['pngPicture']['name'],PATHINFO_EXTENSION); // Icon
    $img = move_uploaded_file($_FILES["pngPicture"]["tmp_name"], $target_file); // Upload file
    if ($img) {
        mysqli_query($connection,"UPDATE user SET picture = '". $user . "-". $username . "." . pathinfo($_FILES['pngPicture']['name'],PATHINFO_EXTENSION)."' WHERE user_id = $user");
    }
    mysqli_query($connection,"UPDATE user SET username = '$username', password = '$password', nickname = '$nickname', bio = '$bio', address = '$address', level = '$level'
    WHERE user_id = $user");

    // Below are the directory for specific uploads.

    if (isset($_POST['admin'])) {
        // This only comes from the dashboard
        header("Location: ../dashboard/");
    } else {
        // Public uses
        header("Location: ../user.php?id=".$user);
    }
}
?>