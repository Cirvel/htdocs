<?php
session_start();
include 'connection.php';

$download_file = pathinfo($_FILES['download'] ['name'], PATHINFO_EXTENSION); // Download file
$allowed = array('rar', 'zip', '7z'); // Allowed extension for download file

$uploadOk = 1; // The green light for uploading mod

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imgIcon"]["tmp_name"]); // Get file size for icon
    $check2 = getimagesize($_FILES["imgThumbnail"]["tmp_name"]); // Get file size for icon

    if ($check && $check2) { // Check if both icon and thumbnail isn't not an image]
        $uploadOk = 1;
        if ($_FILES["imgIcon"] ["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($_FILES["imgThumbnail"] ["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    } else {
        echo "Icon or Thumbnail is not an image";
        $uploadOk = 0;
    }
    // if (!in_array($download_file, $allowed)) { // Deprecated, already using zipping.js
    //     echo "Uploaded file is not a an archive type";
    //     $uploadOk = 0;
    // }
}

if ($uploadOk == 1) { // If the mod passed the file check, upload
    $user_id = $_SESSION['id'];
    $mod_id = $_POST['mod_id'];
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $genre_id = $_POST['genre'];
    // $imgIcon = basename($_FILES["imgIcon"] ["name"]);
    // $imgThumbnail = basename($_FILES["imgThumbnail"] ["name"]);
    // $download = basename($_FILES["download"] ["name"]);
    // $hidden = 0;

    mysqli_query($connection,"UPDATE modfile SET title = '$title', description = '$description', genre_id = $genre_id, date_updated = current_timestamp() WHERE mod_id = $mod_id");

    // Below are the directory for specific uploads.
    $target_file = "../assets/images/mod_icon/" . $mod_id . "." . pathinfo($_FILES['imgIcon']['name'],PATHINFO_EXTENSION); // Icon
    $target_file2 = "../assets/images/mod_thumbnail/" . $mod_id . "." . pathinfo($_FILES['imgThumbnail']['name'],PATHINFO_EXTENSION); // Thumbnail
    $target_file3 = "../assets/downloads/" . $mod_id . "." . pathinfo($_FILES['download']['name'],PATHINFO_EXTENSION); // Download file
    
    $filer = move_uploaded_file($_FILES["imgIcon"]["tmp_name"], $target_file);
    if ($filer) { // Replace icon
        mysqli_query($connection, "UPDATE modfile SET icon = '".$mod_id . "." . pathinfo($_FILES['imgIcon']['name'],PATHINFO_EXTENSION)."' WHERE mod_id = $mod_id");
    }
    $filer = move_uploaded_file($_FILES["imgThumbnail"]["tmp_name"], $target_file2);
    if ($filer) { // Replace thumbnail
        mysqli_query($connection, "UPDATE modfile SET thumbnail = '".$mod_id . "." . pathinfo($_FILES['imgThumbnail']['name'],PATHINFO_EXTENSION)."' WHERE mod_id = $mod_id");
    }
    $filer = move_uploaded_file($_FILES["download"]["tmp_name"], $target_file3);
    if ($filer) { // Replace download file
        mysqli_query($connection, "UPDATE modfile SET download_file = '".$mod_id . "." . pathinfo($_FILES['download']['name'],PATHINFO_EXTENSION)."' WHERE mod_id = $mod_id");
    }
    
    if (isset($_POST['admin'])) {
        // This only comes from the dashboard
        header("Location: ../dashboard/");
    } else {
        // Public uses
        header("Location: ../mod.php?id=".$mod_id);
    }
}
?>