<?php
session_start();

if (!isset($_SESSION['id'])) {
    // If not logged in, direct to login
    header("location:../session/login.php");
} else if ($_SESSION['level'] != "admin") {
    // If logged in but not admin, kick to front page
    header("location:../");
}

require '../backend/connection.php';
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="..\assets\css\main.css">
    <link rel="stylesheet" href="../assets/fontawesome-6.4.2/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <title>Warehouse</title>
</head>
<header>
    <div class="header" style="position: fixed;">
        <a href="#">
            <div class="icon">
                <img src="../assets/images/icon_shadow.png" alt="icon">
            </div>
        </a>
        <div class="nav-list">
            <nav>
                <a href="../"><button class="btn-inv">HOME</button></a>
                <a href="../library.php"><button class="btn-inv">LIBRARY</button></a>
                <a href='../user.php'><button class='btn-inv' id='user' title="<?php echo $_SESSION['nickname'] ?>"><?php echo $_SESSION['nickname'] ?></button></a>
                <a href='../session/logout.php' id='login'><button class='btn-inv'><i class='fa fa-sign-out'></i></button></a>
            </nav>
            <div class="hamburger">
                <i class="fa fa-navicon"></i>
                <div class="dropdown">
                    <a href="../">Home</a>
                    <a href='../user.php'><button class='btn-inv' id='user' title="<?php echo $_SESSION['nickname'] ?>"><?php echo $_SESSION['nickname'] ?></button></a>
                    <a href='../session/logout.php'>Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>

<body>
    <div class="gap"></div>
    <div class="form-body">
        <h1><i class="fa fa-database"></i> Select Database</h1>
        <hr>
        <table>
            <tr>
                <td>
                    <a href="user_list.php"><button class='btn'><i class='fa fa-users'></i> User Database</button></a>
                </td>
                <td>
                    <a href="genre_list.php"><button class='btn'><i class='fa fa-list'></i> Genre Database</button></a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="mod_list.php"><button class='btn'><i class='fa fa-box'></i> Mod Database</button></a><br>
                </td>
                <td>
                    <a href="comment_list.php"><button class='btn'><i class='fa fa-comments'></i> Comment Database</button></a>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <a href="suggestions.php"><button class='btn'><i class='fa fa-brain'></i> Suggestions</button></a><br>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>