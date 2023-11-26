<?php
session_start();
$user = $_SESSION['id'];
$mod = $_GET['mod'];
$status = $_GET['status'];

include 'connection.php';

if (!isset( $status ) || !$user) { // Failsafe if status doesnt have a method
    header('Location: ../index.php');
    exit;
}

$sql = mysqli_query($connection,"SELECT * FROM opinion WHERE user_id = '$user' AND mod_id = '$mod' AND type = '$status'")->fetch_assoc();


if (!$sql) { // If no opinion data are found, create one
    $sql1 = mysqli_query($connection,"INSERT INTO opinion (user_id, mod_id, type,date_critic,enabled) VALUES ('$user','$mod','$status',current_timestamp(),1)");
    $data = mysqli_query($connection,"SELECT * FROM opinion WHERE user_id = '$user' AND mod_id = '$mod' AND type = '$status'")->fetch_assoc();
    if ($data["type"] == "downvote") {
        $id = $data["mod_id"]; // If create new downvote, disable upvote
        mysqli_query($connection,"UPDATE opinion SET enabled = 0 WHERE mod_id = $mod AND type = 'upvote'");
    } else if ( $data["type"] == "upvote") {
        $id = $data["mod_id"]; // If create new upvote, disable downvote
        mysqli_query($connection,"UPDATE opinion SET enabled = 0 WHERE mod_id = $mod AND type = 'downvote'");
    }
} else if ($sql['type'] == "favorite") {
    if ($sql['enabled']) {
        mysqli_query($connection,"UPDATE opinion SET enabled = 0 WHERE mod_id = $mod AND type = '$status'");
    } else { //(!$check_sql['enabled'])
        mysqli_query($connection,"UPDATE opinion SET enabled = 1 WHERE mod_id = $mod AND type = '$status'");
    }
} else { // Upvote Downvote
    if ($sql['type'] == "downvote") { // If user click downvote
        if ($sql['enabled']) { // If already downvoted, undownvote
            mysqli_query($connection,"UPDATE opinion SET enabled = 0 WHERE mod_id = $mod AND type = 'downvote'");
        } else { // If hadn't downvoted, downvote now
            mysqli_query($connection,"UPDATE opinion SET enabled = 0 WHERE mod_id = $mod AND type = 'upvote'");
            mysqli_query($connection,"UPDATE opinion SET enabled = 1 WHERE mod_id = $mod AND type = 'downvote'");
        }
    } else if ($sql['type'] == "upvote" ) { // If user click upvoted
        if ($sql['enabled']) { // If already upvoted, unupvote
            mysqli_query($connection,"UPDATE opinion SET enabled = 0 WHERE mod_id = $mod AND type = 'upvote'");
        } else { // If hadn't upvoted, upvote now
            mysqli_query($connection,"UPDATE opinion SET enabled = 1 WHERE mod_id = $mod AND type = 'upvote'");
            mysqli_query($connection,"UPDATE opinion SET enabled = 0 WHERE mod_id = $mod AND type = 'downvote'");
        }
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>