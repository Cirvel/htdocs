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

$editing_type = null; // User or Mod
$id = null;
$sql = null;

if (isset($_GET['user'])) {
    // Display editing module for user
    $editing_type = "user";
    $id = $_GET['user'];
} else if (isset($_GET['mod'])) {
    // Display editing module for mod
    $editing_type = "mod";
    $id = $_GET['mod'];
} else if (isset($_GET['genre'])) {
    // Display editing module for genre
    $editing_type = "genre";
    $id = $_GET['genre'];
} else if (isset($_GET['comment'])) {
    // Display editing module for comment
    $editing_type = "comment";
    $id = $_GET['comment'];
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
                <a href="."><button class="btn-inv">BACK</button></a>
            </nav>
            <div class="hamburger">
                <i class="fa fa-navicon"></i>
                <div class="dropdown">
                    <a href=".">Home</a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Body -->

<body>
    <div class="gap"></div>
    <?php
    // Editing user
    if ($editing_type == "user") { ?>
        <form class="container-form" action="../backend/account_update.php" method="post" enctype="multipart/form-data">
            <?php
            $sql = mysqli_query($connection, "SELECT * FROM user WHERE user_id = $id");
            $data = mysqli_fetch_assoc($sql);
            if (!$data) { // Failsafe
                header("location:.");
            }
            ?>
            <div class="form-body">
                <input type="text" name="admin" id="admin" value="1" hidden>
                <input type="text" name="user_id" id="user_id" value="<?php echo $data['user_id'] ?>" hidden>
                <table>
                    <h3>CONFIGURING ACCOUNT</h3>
                    <tr>
                        <td>Profile Picture (Leave blank to keep)</td>
                        <td>:</td>
                        <td><input type="file" name="pngPicture" id="pngPicture" accept=".png,.jpg,.jpeg"></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="text" name="nickname" id="nickname" placeholder="Nickname" value="<?php echo $data['nickname'] ?>" required></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="text" name="username" id="username" placeholder="Username" value="<?php echo $data['username'] ?>" required></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="text" name="password" id="password" placeholder="Password" value="<?php echo $data['password'] ?>" required></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="email" name="email" id="email" placeholder="Email" value="<?php echo $data['email'] ?>" required></td>
                    </tr>
                    <tr>
                        <td colspan="3"><textarea name="bio" id="bio" cols="30" rows="10" placeholder="Bio, Describe yourself!" required><?php echo $data['bio'] ?></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="3"><textarea name="address" id="address" cols="30" rows="2" placeholder="Address" required><?php echo $data['address'] ?></textarea></td>
                    </tr>
                    <tr>
                        <td>
                            <select name="level" id="leve">
                                <option value="admin">Admin</option>
                                <option value="mod">Moderator</option>
                                <option value="basic">Basic</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <input type="submit" class="btn-inv">
            </div>
        </form>
    <?php
    // Editing mod
    } else if ($editing_type == "mod") {?>
        <form class="container-form" action="../backend/mod_update.php" method="post" enctype="multipart/form-data">
            <?php
            $sql = mysqli_query($connection,"SELECT * FROM modfile WHERE mod_id = $id");
            $data = mysqli_fetch_assoc($sql);
            if (!$data) { // Failsafe
                header("location:.");
            }
            ?>
            <div class="form-body">
                <input type="text" name="admin" id="admin" value="1" hidden>
                <input type="text" name="mod_id" id="mod_id" value="<?php echo $id ?>" hidden>
                <table>
                    <tr>
                    <td>Icon</td>
                    <td>:</td>
                    <td>
                        <!-- Input icon for the mod on the library -->
                        <input type="file" name="imgIcon" id="imgIcon" accept=".png,.jpg,.jpeg" value="assets/images/mod_icon/<?php echo $data['icon'] ?>">
                        .png, .jpg, .jpeg
                    </td>
                </tr>
                <tr>
                    <td>Thumbnail</td>
                    <td>:</td>
                    <td>
                        <!-- Place thumbnail for mod in modpage -->
                        <input type="file" name="imgThumbnail" id="imgThumbnail" accept=".png,.jpg,.jpeg" value="assets/images/mod_thumbnail/<?php echo $data['thumbnail'] ?>">
                        .png, .jpg, .jpeg
                    </td>
                </tr>
                <tr>
                    <td>File</td>
                    <td>:</td>
                    <td>
                        <!-- Upload file for people to download -->
                        <input type="file" name="download" id="download" accept=".zip,.rar" value="assets/downloads/<?php echo $data['download_file'] ?>">
                        .zip, .rar
                    </td>
                </tr>
                <tr>
                    <td>Genre</td>
                    <td>:</td>
                    <td>
                        <select name="genre" id="genre">
                            <?php
                            $sql_genre = mysqli_query($connection,"SELECT * FROM genre");
                            
                            while ($data_gen = mysqli_fetch_array($sql_genre)) {
                                // If the genre is the same with the mod's genre, then select it by default.
                                $nagisa = $data_gen["genre_id"] == $data["genre_id"] ;
                                ?>
                                <option value="<?php echo $data_gen['genre_id'] ?>" <?php echo $nagisa ? "selected" : "" ?> title="<?php echo $data_gen['genre_desc']?>"><?php echo $data_gen['genre_name'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="text" name="title" id="title" placeholder="Title" value="<?php echo $data['title'] ?>" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" required><?php echo $data['description'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <!-- <td title="Only you can view this mod">
                        <input type="checkbox" name="hidden" id="hidden">
                        <label for="hidden">Private only</label>
                    </td> -->
                </tr>
            </table>
            <input type="submit" value="Edit" id="submit2" name="submit2">
        </div>
        </form>
    <?php }
    // Editing genre
    else if ($editing_type == "genre") {?>
        <form class="container-form" action="../backend/genre_update.php" method="post">
            <?php
            $sql = mysqli_query($connection,"SELECT * FROM genre WHERE genre_id = $id");
            $data = mysqli_fetch_assoc($sql);
            if (!$data) { // Failsafe
                header("location:.");
            }
            ?>
            <div class="form-body">
                <input type="text" name="admin" id="admin" value="1" hidden>
                <input type="text" name="genre_id" id="genre_id" value="<?php echo $data['genre_id']?>" hidden>
                <table>
                <tr>
                    <td colspan="3">
                        <input type="text" name="title" id="title" placeholder="Title" value="<?php echo $data['genre_name'] ?>" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" required><?php echo $data['genre_desc'] ?></textarea>
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
    <?php }
    // Editing comment
    else if ($editing_type == "comment") {?>
        <form class="container-form" action="../backend/comment_update.php" method="post">
            <?php
            $sql = mysqli_query($connection,"SELECT *, user.user_id AS userid FROM comment JOIN user ON user.user_id = comment.user_id JOIN modfile ON modfile.mod_id = comment.mod_id WHERE comment_id = $id");
            $data = mysqli_fetch_assoc($sql);
            if (!$data) { // Failsafe
                header("location:.");
            }
            ?>
            <div class="form-body">
                <input type="text" name="admin" id="admin" value="1" hidden>
                <input type="text" name="comment_id" id="comment_id" value="<?php echo $data['comment_id']?>" hidden>
                <table>
                    <tr>
                        <td>User</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="placeholder" id="user" value="@<?php echo $data['username']?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Mod</td>
                        <td>:</td>
                        <td>
                        <input type="text" name="placeholder" id="mod" value="<?php echo $data['title']?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <textarea name="content" id="content" cols="30" rows="10" placeholder="Description" required><?php echo $data['content'] ?></textarea>
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
    <?php } ?>
</body>
    <script src="../assets/js/jquery-3.6.0.min.js"></script> <!-- Supplements zipping.js -->
    <script src="../assets/js/zipping.js"></script> <!-- Script that check if 'download' input is a winrar type -->
</html>