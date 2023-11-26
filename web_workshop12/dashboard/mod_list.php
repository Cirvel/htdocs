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
        <!-- <a href="."><button class='btn-red'><i class='fa fa-arrow-left'></i> Back</button></a> -->
        <div class="form-body">
            <h4><i class="fa fa-box"></i> MODS</h4>
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
                    $sql = mysqli_query($connection,"SELECT * FROM modfile JOIN genre ON genre.genre_id = modfile.genre_id JOIN user ON user.user_id = modfile.user_id");
                    $no = 1;
                    while ($row = mysqli_fetch_array($sql)) {?>
                        <tr>
                            <!-- New Method for Php!!! -->
                            <td><?= $row['mod_id'] ?></td>
                            <td><?= "<img src='../assets/images/mod_icon/". $row['icon'] ."' alt='". $row['icon'] ."'>" ?></td>
                            <td><?= "<img src='../assets/images/mod_thumbnail/". $row['thumbnail'] ."' alt='". $row['thumbnail'] ."'>" ?></td>
                            <td><a class="linked" href="<?= "../assets/downloads/". $row['download_file'] ?>">Download</a></td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['description'] ?></td>
                            <td><a href="../user.php?id=<?= $row['user_id'] ?>" class="linked"><?= "@".$row['username'] ?></a></td>
                            <td><?= "<i class='fa fa-calendar'> Updated</i>". $row['date_updated'] . "<br><i class='fa fa-clock'> Created</i>" . $row['date_created'] ?></td>
                            <?php
                            $sql_favorites = mysqli_query($connection,"SELECT * FROM opinion WHERE mod_id = ". $row['mod_id'] ." AND type = 'favorite' AND enabled = 1");
                            $sql_upvotes = mysqli_query($connection,"SELECT * FROM opinion WHERE mod_id = ". $row['mod_id'] ." AND type = 'upvote' AND enabled = 1");
                            $sql_downvotes = mysqli_query($connection,"SELECT * FROM opinion WHERE mod_id = ". $row['mod_id'] ." AND type = 'downvote' AND enabled = 1");
                            $sql_comments = mysqli_query($connection,"SELECT * FROM comment WHERE mod_id = ". $row['mod_id']);
                            ?>
                            <td><?= 
                            "<i class='fa fa-star'></i> ".mysqli_num_rows($sql_favorites) .
                            "<br><i class='fa fa-thumbs-up'></i> ".mysqli_num_rows($sql_upvotes) .
                            "<br><i class='fa fa-thumbs-down'></i> ".mysqli_num_rows($sql_downvotes) .
                            "<br><i class='fa fa-comment'></i> ".mysqli_num_rows($sql_comments)
                             ?></td>
                            <td id="action">
                                <a href="edit.php?mod=<?= $row['user_id'] ?>">
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
                window.location.href=("../backend/delete.php?mod="+id);
            } else {
                return false;
            }
        }
    </script>
</html>