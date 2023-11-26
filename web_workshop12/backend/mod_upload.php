<?php
session_start();
include 'connection.php';

$download_file = pathinfo($_FILES['download'] ['name'], PATHINFO_EXTENSION); // Download file
$allowed = array('rar', 'zip'); // Allowed extension for download file

$uploadOk = 1; // The green light for uploading mod

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imgIcon"]["tmp_name"]); // Get file size for icon
    $check2 = getimagesize($_FILES["imgThumbnail"]["tmp_name"]); // Get file size for icon

    if ($check && $check2) { // Check if both icon and thumbnail isn't not an image]
        $uploadOk = 1;
        if ($_FILES["imgIcon"] ["size"] > 1500000) {
            echo "Sorry, your file is too large1.";
            $uploadOk = 0;
        }
        if ($_FILES["imgThumbnail"] ["size"] > 1500000) {
            echo "Sorry, your file is too large2.";
            $uploadOk = 0;
        }
    } else {
        echo "Icon or Thumbnail is not an image";
        $uploadOk = 0;
    }
    // if (!in_array($download_file, $allowed)) { // Deprecated, already using zipping.js
    //     echo "Uploaded file is not a winrar type";
    //     $uploadOk = 0;
    // }
}

if ($uploadOk == 1) { // If the mod passed the file check, upload
    $user_id = $_SESSION['id'];
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $genre_id = $_POST['genre'];
    // $imgIcon = basename($_FILES["imgIcon"] ["name"]);
    // $imgThumbnail = basename($_FILES["imgThumbnail"] ["name"]);
    // $download = basename($_FILES["download"] ["name"]);
    $hidden = 0;

    $sql = mysqli_query($connection,"INSERT INTO modfile 
    (mod_id,user_id,date_created,date_updated,title,description,genre_id,hidden) VALUES 
    (NULL, '$user_id',current_timestamp(),current_timestamp(),'$title','$description','$genre_id','$hidden')"); // Buat row database
    
    // Find the last inserted id, which is the one above.
    $sql_id = mysqli_query($connection,"SELECT * FROM modfile WHERE mod_id = LAST_INSERT_ID()")->fetch_assoc();

    // Below are the directory for specific uploads.
    $target_file = "../assets/images/mod_icon/" . $sql_id['mod_id'] . "." . pathinfo($_FILES['imgIcon']['name'],PATHINFO_EXTENSION); // Icon
    $target_file2 = "../assets/images/mod_thumbnail/" . $sql_id['mod_id'] . "." . pathinfo($_FILES['imgThumbnail']['name'],PATHINFO_EXTENSION); // Thumbnail
    $target_file3 = "../assets/downloads/" . $sql_id['mod_id'] . "." . pathinfo($_FILES['download']['name'],PATHINFO_EXTENSION); // Download file

    if (
        $sql_id &&
        move_uploaded_file($_FILES["imgIcon"]["tmp_name"], $target_file) &&
        move_uploaded_file($_FILES["imgThumbnail"]["tmp_name"], $target_file2) &&
        move_uploaded_file($_FILES["download"]["tmp_name"], $target_file3)
        ) { // Upload file
        // echo "The file ". htmlspecialchars( basename($_FILES["fileToUpload"]["name"])) ."has been uploaded.";
        
        $sql_upd = mysqli_query($connection,"UPDATE modfile SET 
        icon = '". $sql_id['mod_id'] . "." . pathinfo($_FILES['imgIcon']['name'],PATHINFO_EXTENSION) ."', 
        thumbnail = '". $sql_id['mod_id'] . "." . pathinfo($_FILES['imgThumbnail']['name'],PATHINFO_EXTENSION) ."', 
        download_file = '". $sql_id['mod_id'] . "." . pathinfo($_FILES['download']['name'],PATHINFO_EXTENSION)  ."' WHERE mod_id = ". $sql_id['mod_id']);
    }
    header("Location: ../library.php");
}
?>