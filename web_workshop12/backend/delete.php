<?php
session_start();

include 'connection.php';

if (!isset($_SESSION['id'])) {
    // If theres no session, kick out
    header('Location: ../');
} else

if (isset($_GET['comment'])) {
    $id = $_GET['comment'];

    // Try to find the id data
    $php = mysqli_query($connection, "SELECT * FROM comment WHERE comment_id = $id")->fetch_assoc();
    if (!$php) { // If not found, return back to prevent error
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    if ($_SESSION['id'] != $php['user_id'] && $_SESSION['level'] != "admin" ) {
        // If user is not the same as poster or is not an admin, kick out
        header('Location: ../');
    }

    mysqli_query($connection, "DELETE FROM comment WHERE comment_id = $id");
} else if (isset($_GET['mod'])) {
    $id = $_GET['mod'];
    
    $php = mysqli_query($connection, "SELECT * FROM mod WHERE mod_id = $id")->fetch_assoc();
    if (!$php) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    if ($_SESSION['id'] != $php['user_id'] && $_SESSION['level'] != "admin" ) {
        // If user is not the same as poster or is not an admin, kick out
        header('Location: ../');
    }

    mysqli_query($connection, "DELETE FROM mod WHERE mod_id = $id");
} else if (isset($_GET['user'])) {
    $id = $_GET['user'];

    $php = mysqli_query($connection, "SELECT * FROM user WHERE user_id = $id")->fetch_assoc();
    if (!$php) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    if ($_SESSION['id'] != $php['user_id'] && $_SESSION['level'] != "admin" ) {
        // If user is not the same as poster or is not an admin, kick out
        header('Location: ../');
    }

    mysqli_query($connection, "DELETE FROM user WHERE user_id = $id");
} else if (isset($_GET['genre'])) {
    $id = $_GET['genre'];

    $php = mysqli_query($connection, "SELECT * FROM genre WHERE genre_id = $id")->fetch_assoc();
    if (!$php) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    if ($_SESSION['level'] != "admin" ) {
        // If user is not an admin, kick out
        header('Location: ../');
    }

    mysqli_query($connection, "DELETE FROM genre WHERE genre_id = $id");
} else if (isset($_GET['contact'])) {
    $id = $_GET['contact'];

    $php = mysqli_query($connection, "SELECT * FROM admin_contact WHERE contact_id = $id")->fetch_assoc();
    if (!$php) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    if ($_SESSION['level'] != "admin" ) {
        // If user is not an admin, kick out
        header('Location: ../');
    }

    mysqli_query($connection, "DELETE FROM admin_contact WHERE contact_id = $id");
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;