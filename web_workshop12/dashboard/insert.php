<?php 
session_start();
if ($_SESSION['status'] != "login") {
    header("location:session/login.php?msg=none");
}

include '../backend/connection.php';

if (!isset($_SESSION['id'])) {
    // If not logged in, direct to login
    header("location:../session/login.php");
} else if ($_SESSION['level'] != "admin") {
    // If logged in but not admin, kick to front page
    header("location:../");
}

$insert_type = null; // User or Mod
$id = null;
$sql = null;

if (isset($_GET['genre'])) {
    // Display editing module for genre
    $insert_type = "genre";
} else {
    // If not method are sent, kick to index
    header("location:.");
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Lithematics</title>
        <link rel="icon" href="../assets/images/icon.png">
        <link rel="stylesheet" href="../assets/css/main.css">
        <link rel="stylesheet" href="../assets/fontawesome-6.4.2/css/all.min.css">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> -->
    </head>
    <!-- Header -->
    <header>
        <div class="header" style="position: fixed;">
            <a href="#">
                <div class="icon">
                        <img src="../assets/images/icon_shadow.png" alt="icon">
                </div>
            </a>
            <div class="nav-list">
                <nav>
                    <a href="index.php"><button class="btn-inv">DASHBOARD</button></a>
                </nav>
                <div class="hamburger">
                    <i class="fa fa-navicon"></i>
                    <div class="dropdown">
                        <a href="index.php">Home</a>
                        <?php
                            echo "<a href='session/logout.php'>Logout</a>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Body -->
    <body>
        <div class="gap"></div>
        <!-- Mod List -->
        <form class="container-form" action="../backend/genre_insert.php" method="post">
            <input type="text" name="admin" id="admin" value="1" hidden>
            <div class="form-body">
                <table>
                <tr>
                    <td colspan="3">
                        <input type="text" name="title" id="title" placeholder="Title" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" required></textarea>
                    </td>
                </tr>
                <tr>
                    <!-- <td title="Only you can view this mod">
                        <input type="checkbox" name="hidden" id="hidden">
                        <label for="hidden">Private only</label>
                    </td> -->
                </tr>
            </table>
            <input type="submit" value="Submit" id="submit" name="submit">
        </div>
        </form>
    </body>
</html>