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
            <h4><i class="fa fa-users"></i> USERS</h4>
            <table id="table-data" class="table-data">
                <thead>
                    <tr class="table-header">
                        <th>ID</th>
                        <th>Image</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Nickname</th>
                        <th>Bio</th>
                        <th>Address</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = mysqli_query($connection,"SELECT * FROM user");
                    $no = 1;
                    while ($row = mysqli_fetch_array($sql)) {?>
                        <tr>
                            <!-- New Method for Php!!! -->
                            <td><?= $row['user_id'] ?></td>
                            <td><?= "<img src='../assets/images/user_icon/". $row['picture'] ."' alt='". $row['picture'] ."'>" ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['password'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['nickname'] ?></td>
                            <td><?= $row['bio'] ?></td>
                            <td><?= $row['address'] ?></td>
                            <td><?= $row['level'] ?></td>
                            <td id="action">
                                <a href="edit.php?user=<?= $row['user_id'] ?>">
                                    <button class="btn-orange"><i class="fa fa-edit"></i></button>
                                </a>
                                <a href="#">
                                    <button onclick="deletion(<?= $row['user_id'] ?>)" class="btn-red"><i class="fa fa-trash"></i></button>
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
                window.location.href=("../backend/delete.php?user="+id);
            } else {
                return false;
            }
        }
    </script>
</html>