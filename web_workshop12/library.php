<?php 
	session_start();

    $status = false; // check if session exists

    if(isset( $_SESSION["status"]) && $_SESSION["status"] == "login"){
        $status = true;
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
                    <?php
                        if($status){
                            echo "<a href='user.php'><button class='btn-inv' id='user' title='". $_SESSION['nickname'] ."'>".$_SESSION['nickname']."</button></a>";
                            echo "<a href='session/logout.php' id='login'><button class='btn-inv'><i class='fa fa-sign-out'></i></button></a>";
                        } else {
                            echo "<a href='session/login.php' id='login'><button class='btn-inv'><i class='fa fa-sign-in'></i></button></a>";
                        }
                    ?>
                </nav>
                <div class="hamburger">
                    <i class="fa fa-navicon"></i>
                    <div class="dropdown">
                        <a href="index.php">Home</a>
                        <a href="library.php">Library</a>
                        <?php
                            if($status){
                                echo "<a href='session/login.php'>Login</a>";
                            } else {
                                echo "<a href='session/logout.php'>Logout</a>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Body -->
    <body>
        <div class="gap"></div>
        <div class="search">
            <form method="get" action="">
                <div class="div">
                    <label for="genre">Genre:</label>
                    <select name="genre" id="genre">
                        <option value=0>Select genre</option>
                        <?php
                            $sql_genre = mysqli_query($connection,"SELECT * FROM genre ORDER BY genre_name");
                            while ($row = mysqli_fetch_array($sql_genre)) { 
                                $tsuguri = isset($_GET['genre']) && $row['genre_id'] == $_GET['genre'];
                                ?>
                                <option value=<?php echo $row['genre_id']?> title="<?php echo $row['genre_desc']?>"<?php echo  $tsuguri ? "selected" : ""?>><?php echo $row['genre_name']?></option>
                            <?php };
                        ?>
                    </select>
                    <input type="search" name="search" id="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>">
                    <button><i class="fa fa-search"></i></button> |
                    <a href="createmod.php">
                        <button type="button">Create Mod</button>
                    </a>
                </div>
            </form>
        </div>
        <!-- Mod List -->
        <div class="container-list">
            <!-- Mod -->
            <?php
                // Select mods depending on search form
                $sql_mod = mysqli_query($connection,"SELECT * FROM modfile JOIN user ON user.user_id = modfile.user_id JOIN genre ON genre.genre_id = modfile.genre_id ORDER BY downloads");
                if (isset($_GET['genre']) && $_GET['genre'] > 0 && $_GET['search'] != "") {
                    // If both genre and search bar is filled
                    $sql_mod = mysqli_query($connection,"SELECT * FROM modfile JOIN user ON user.user_id = modfile.user_id JOIN genre ON genre.genre_id = modfile.genre_id WHERE modfile.genre_id = ". $_GET['genre'] ." AND (title LIKE LOWER('%". $_GET['search'] ."%') OR description LIKE LOWER('%". $_GET['search'] ."%'))");
                } else if (isset($_GET['genre']) && $_GET['genre'] == 0 && $_GET['search'] != "") {
                    // If no genre are selected but search bar is typed
                    $sql_mod = mysqli_query($connection,"SELECT * FROM modfile JOIN user ON user.user_id = modfile.user_id JOIN genre ON genre.genre_id = modfile.genre_id WHERE title LIKE LOWER('%". $_GET['search'] ."%') OR description LIKE LOWER('%". $_GET['search'] ."%')");
                } else if (isset($_GET['genre']) && $_GET['genre'] > 0 && $_GET['search'] == "") {
                    // If search bar isnt filled but genre is selected
                    $sql_mod = mysqli_query($connection,"SELECT * FROM modfile JOIN user ON user.user_id = modfile.user_id JOIN genre ON genre.genre_id = modfile.genre_id WHERE modfile.genre_id = ". $_GET['genre']);
                }
                
                while ($row = mysqli_fetch_array($sql_mod)) { 
                    $mod_id = $row['mod_id'];
                    // Mod will not show if hidden is toggled on and the owner is not the same as the currently logged in account
                    $hidden = $row['hidden'] && $_SESSION['id'] != $row['user_id'] && $_SESSION['level'] != ("admin" || "mod");
                    ?>
                    <a href="mod.php?id=<?php echo $mod_id ?>" <?php echo $hidden ? "style='display:none;'" : ""?>>
                        <div class="modlist" <?php echo $hidden ? "style='display:none;'" : ""?> style="cursor:pointer;" >
                            <div class="modlist-image">
                                <img src="assets/images/mod_icon/<?php echo $row['icon']?>" alt="No picture available">
                            </div>
                            <span>
                                <div class="genre">
                                    <p><?php echo $row['genre_name']?></p>
                                </div>
                                <p>By <a href="user.php?id=<?php echo $row['user_id']?>" title="<?php echo $row['nickname'] ?>">@<?php echo $row['username']?></a></p>
                                <h3><?php echo $row['title']?></h3>
                            </span>
                            <!-- <div class="cnt" title="Total Downloads"><i class="fa fa-download"></i><?php
                                $sql_downloads = mysqli_query($connection,"SELECT * FROM opinion WHERE mod_id = $mod_id  AND type = 'download' AND enabled = 1");
                                echo " " . number_format(mysqli_num_rows($sql_downloads)) ?></div> -->
                            <span>
                                <a href="assets/downloads/<?php echo $row['download_file'] ?>" download="<?php echo $row['username'] . "_" . $row['title'] ?>.rar">
                                    <button>DOWNLOAD</button>
                                </a>
                                <a href="contact.php?badmod=<?php echo $row['mod_id']?>">
                                    <button class="btn-red" title="Report Mod"><i class="fa fa-flag"></i></button>
                                </a>
                            </span>
                        </div>
                    </a>
                <?php }
            ?>
            <br>
        </div>
        <!-- <div class="switch">
            <p>
                <a href="">
                    <i class="fa fa-arrow-left"></i>
                </a>
                1/1
                <a href="">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </p>
        </div> -->
        <footer class="footer">
            <ul>
                <a href="rules.php">
                    <li><button>RULES</button></li>
                </a>
                <a href="contact.php">
                    <li><button>CONTACT</button></li>
                </a>
            </ul>
        </footer>
    </body>

    <script>
        function mod_link(id){
            window.location.href=("opinion.php?id="+id);
        }
    </script>
</html>