<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:session/login.php?msg=none");
	}
    include 'backend/connection.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Lithematics</title>
        <link rel="icon" href="assets/images/icon.png">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/fontawesome-6.4.2/css/all.min.css">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> -->
    </head>
    <!-- Header -->
    <header>
        <div class="header" style="position: fixed;">
            <a href="#">
                <div class="icon">
                        <img src="assets/images/icon_shadow.png" alt="icon">
                </div>
            </a>
            <div class="nav-list">
                <nav>
                    <a href="index.php"><button class="btn-inv">HOME</button></a>
                    <a href="library.php"><button class="btn-inv selected" >LIBRARY</button></a>
                    <a href="contact.php"><button class="btn-inv">CONTACT</button></a>
                    <?php
                        echo "<a href='user.php'><button class='btn-inv' id='user' title='". $_SESSION['nickname'] ."'". $_SESSION['nickname'] ."'>".$_SESSION['nickname']."</button></a>";
                        echo "<a href='session/logout.php' id='login'><button class='btn-inv'><i class='fa fa-sign-out'></i></button></a>";
                    ?>
                </nav>
                <div class="hamburger">
                    <i class="fa fa-navicon"></i>
                    <div class="dropdown">
                        <a href="index.php">Home</a>
                        <a href="library.php">Library</a>
                        <a href="contact.php">Contact</a>
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
        <form class="container-form" action="backend/mod_upload.php" method="post" enctype="multipart/form-data">
            <div class="form-body">
                <table>
                    <tr>
                    <td>Icon</td>
                    <td>:</td>
                    <td>
                        <!-- Input icon for the mod on the library -->
                        <input type="file" name="imgIcon" id="imgIcon" accept=".png,.jpg,.jpeg" required>
                        .png, .jpg, .jpeg
                    </td>
                </tr>
                <tr>
                    <td>Thumbnail</td>
                    <td>:</td>
                    <td>
                        <!-- Place thumbnail for mod in modpage -->
                        <input type="file" name="imgThumbnail" id="imgThumbnail" accept=".png,.jpg,.jpeg" required>
                        .png, .jpg, .jpeg
                    </td>
                </tr>
                <tr>
                    <td>File</td>
                    <td>:</td>
                    <td>
                        <!-- Upload file for people to download -->
                        <input type="file" name="download" id="download" accept=".zip,.rar" required>
                        .zip, .rar
                    </td>
                </tr>
                <tr>
                    <td>Genre</td>
                    <td>:</td>
                    <td>
                        <select name="genre" id="genre">
                            <?php
                            $sql = mysqli_query($connection,"SELECT * FROM genre");
                            
                            while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                <option value="<?php echo $data['genre_id'] ?>" title="<?php echo $data['genre_desc']?>"><?php echo $data['genre_name'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
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
            <input type="submit" value="Upload" id="submit" name="submit">
        </div>
        </form>
        <script src="assets/js/jquery-3.6.0.min.js"></script> <!-- Supplements zipping.js -->
        <script src="assets/js/zipping.js"></script> <!-- Script that check if 'download' input is a winrar type -->
    </body>
</html>