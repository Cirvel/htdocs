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
                    <a href="."><button class="btn-inv selected">HOME</button></a>
                </nav>
                <div class="hamburger">
                    <i class="fa fa-navicon"></i>
                    <div class="dropdown">
                        <a href="../">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <body>
        <div class="gap"></div>
        <div class="form-body">
            <a href="insert.php?genre=1"><button class='btn-green'><i class='fa fa-plus'></i> Insert Genre</button></a>
            <h4><i class="fa fa-list"></i> GENRES</h4>
            <table style="width: 100%;" id="table-data" class="table-data">
                <thead>
                    <tr class="table-header">
                        <th>ID</th>
                        <th>Game Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = mysqli_query($connection,"SELECT * FROM genre");
                    $no = 1;
                    while ($row = mysqli_fetch_array($sql)) {?>
                        <tr>
                            <!-- New Method for Php!!! -->
                            <td><?= $row['genre_id'] ?></td>
                            <td><?= $row['genre_name'] ?></td>
                            <td><?= $row['genre_desc'] ?></td>
                            <td id="action">
                                <a href="edit.php?genre=<?= $row['genre_id'] ?>">
                                    <button class="btn-orange"><i class="fa fa-edit"></i></button>
                                </a>
                                <a href="#">
                                    <button onclick="deletion(<?= $row['genre_id'] ?>)" class="btn-red"><i class="fa fa-trash"></i></button>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </body>

    <script>
        function deletion(id) {
            const delConfirm = confirm('Confirm?');
            if(delConfirm) {
                window.location.href=("../backend/delete.php?genre="+id);
            } else {
                return false;
            }
        }
    </script>
</html>