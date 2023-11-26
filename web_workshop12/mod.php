<?php 
	session_start();
    include 'backend/connection.php';
    if (!$_GET['id']){ // If the website has no id get, then open the first mod
        header('Location: mod.php?id=1');
    }
    $id = $_GET["id"];

    $user = null;
    $status = false;

    if(isset($_SESSION['status']) && $_SESSION['status']=="login"){
        $status = true;
        $user = $_SESSION['id'];
        $sql_owner = mysqli_query($connection,"SELECT * FROM user WHERE user_id = $user");
    }

    $sql_mod = mysqli_query($connection,"SELECT * FROM modfile JOIN user ON user.user_id = modfile.user_id JOIN genre ON genre.genre_id = modfile.genre_id WHERE mod_id = '$id'");
?>

<!DOCTYPE html>

<html>
    <head>
        <title><?php
        if ($dater = mysqli_fetch_assoc($sql_mod)) {
            echo $dater ? $dater['title'] . " - " : "";
        }
        ?>Lithematics
        </title>
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
                    <!-- <a href="contact.php"><button class="btn-inv">CONTACT</button></a> -->
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
                        <a href="contact.php">Contact</a>
                        <?php
                            if($status){
                                echo "<a href='session/logout.php'>Logout</a>";
                            } else {
                                echo "<a href='session/login.php'>Login</a>";
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
        <!-- Mod List -->
            <!-- Mod -->
            <?php
            $sql_mod = mysqli_query($connection,"SELECT * FROM modfile JOIN user ON user.user_id = modfile.user_id JOIN genre ON genre.genre_id = modfile.genre_id WHERE mod_id = '$id'");
            if( $data = mysqli_fetch_assoc($sql_mod)){
            ?>
            <div class="container-mod">
                <?php
                    if($status && $_SESSION['id']== $data['user_id']){
                        echo "<a href='editmod.php?id=".$id."'><button class='btn-orange'><i class='fa fa-cog'></i> Edit Mod</button></a>";
                    }
                ?>
                <div class="top">
                    <!-- Mod Thumbnail -->
                    <div class="mod-image">
                        <img src="assets/images/mod_thumbnail/<?php echo $data['thumbnail'] ?>" alt="">
                    </div>
                    <!-- Mod Content -->
                    <div class="content">
                        <!-- Title -->
                        <div class="title">
                            <h1 id="title"><?php echo $data['title'] ?></h1>
                            <p id="owner">By <a href="user.php?id=<?php echo $data['user_id'] ?>" class="linked">@<?php echo $data['username'] ?></a></p>
                        </div>
                        <!-- Genre -->
                        <div class="mod-genre" id="mod-genre" style="cursor:pointer;">
                            <a href="library.php?genre=<?php echo $data['genre_id'] ?>&search=">
                                <p><?php echo $data['genre_name'] ?></p>
                            </a>
                        </div>
                        <hr>
                        <!-- Mod Stats -->
                        <div id="stats-mod">
                            <div class="opinion">
                                <!-- <p title="Downloads" id="cnt-download"><i class="fa fa-download"></i><?php
                                    $sql_downloads = mysqli_query($connection,"SELECT * FROM opinion WHERE mod_id = $id AND type = 'download' AND enabled = 1");
                                    echo " ".mysqli_num_rows($sql_downloads) ?>
                                </p> -->
                                <p title="Date Updated (DD/MM/YYYY)" id="date-updated"><i class="fa fa-calendar"></i><?php echo " ".$data['date_updated'] ?></p>
                                <p title="Date Created (DD/MM/YYYY)" id="date-created"><i class="fa fa-clock"></i><?php echo " ".$data['date_created'] ?></p>
                            </div>
                            <br>
                            <div class="opinion">
                                <p title="Favorites" id="cnt-fav" onclick="opinion('favorite')"><i class="fa fa-star"></i><?php
                                    $sql_favorites = mysqli_query($connection,"SELECT * FROM opinion WHERE mod_id = $id AND type = 'favorite' AND enabled = 1");
                                    echo " ".mysqli_num_rows($sql_favorites) ?></p>
                                <p title="Likes" id="rt-up" onclick="opinion('upvote')"><i class="fa fa-thumbs-up"></i><?php
                                    $sql_upvotes = mysqli_query($connection,"SELECT * FROM opinion WHERE mod_id = $id AND type = 'upvote' AND enabled = 1");
                                    echo " ".mysqli_num_rows($sql_upvotes) ?></p>
                                <p title="Dislikes" id="rt-down" onclick="opinion('downvote')"><i class="fa fa-thumbs-down"></i><?php
                                    $sql_downvotes = mysqli_query($connection,"SELECT * FROM opinion WHERE mod_id = $id AND type = 'downvote' AND enabled = 1");
                                    echo " ".mysqli_num_rows($sql_downvotes) ?></p>
                            </div>
                        </div>
                        <div class="download">
                            <!-- <button class="trigger"><h1><i class="fa fa-archive"></i></h1></button>  -->
                            <a href="assets/downloads/<?php echo $data['download_file'] ?>" download="<?php echo $data['username'] . "_" . $data['title'] ?>.rar">
                                <button><h1><i class="fa fa-download"></i> DOWNLOAD</h1></button>
                            </a>
                            <a href="contact.php?badmod=<?php echo $data['mod_id']?>">
                                <button class="btn-red" title="Report Mod"><i class="fa fa-window-close fa-2x"></i></button>
                            </a>
                            <div class="dl-dropdown">
                                <ul>
                                    <li><button>
                                        <a href="">1.1</a>
                                    </button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <hr> -->
                <div class="desc" id="desc-content">
                    <?php echo $data['description'] ?>
                </div>
                <?php } ?>
                <hr>
                <h1>COMMENTS</h1>
                <!-- Comment Form -->
                <?php
                if (isset($_SESSION['id'])) {?>
                    <div class="comment-form">
                    <form method="post" action="backend/post_comment.php">
                        <div class="form-body">
                            <?php
                            $mod_id = $_GET['id'];
                            $user_id = $_SESSION['id'];
                            ?>
                            <input type="number" name="mod" id="mod" value="<?php echo $mod_id ?>" hidden>
                            <input type="number" name="user" id="user" value="<?php echo $user_id ?>" hidden>
                            <p>Post a comment</p>
                            <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Type comment here" required></textarea>
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                    </div>
                <hr>
                <?php } else {?> <br> <?php }
                ?>
                <!-- Comment Section -->
                <div class="comment-section" id="comments">
                    <?php
                    $sql_comment = mysqli_query($connection,"SELECT * FROM comment JOIN user ON user.user_id = comment.user_id WHERE mod_id = $id");

                    while($data = mysqli_fetch_assoc($sql_comment)){?>
                    <div class="comment">
                        <div class="user">
                            <div class="user-picture">
                                <img src="assets/images/user_icon/<?php echo $data['picture'] ?>" alt="pfp">
                            </div>
                            <a href="user.php?id=<?php echo $data['user_id'] ?>">
                                <h3 title="<?php echo $data['nickname'] ?>"><?php echo $data['nickname'] ?></h3>
                                <h5>@<?php echo $data['username'] ?>
                                <?php echo $data['user_id'] == $user ? "(You)" : "" ?>
                                </h5>
                            </a>
                            <p title="Date Posted (YYYY-MM-DD)"><?php echo $data['date_posted'] ?></p>
                        </div>
                        <hr>
                        <div class="comment-content">
                            <!-- <div class="comment-ellipsis">
                                <i class="fa fa-ellipsis-h" id="dropdown"></i>
                                <div class="cm-dropdown">
                                    <a href="">Delete</a>
                                    <a href="">Report</a>
                                </div>
                            </div> -->
                            <div class="hoveron">
                                <i class="fa fa-ellipsis-h"></i>
                                <div class="dropdown" id="dropdown1">
                                    <a href="contact.php?baduser=<?php echo $data['user_id'] ?>">Report</a>
                                    <?php echo $data['user_id'] == $user ? "<a href='backend/delete.php?comment=". $data['comment_id'] ."'>Delete</a>" : "" ?>
                                </div>
                            </div>
                            <br>
                            <?php echo $data['content']?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
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
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        function opinion(opi) {
            // alert(opi);
            <?php
            if (!isset($_SESSION['id'])) { ?>
                var b = window.location.href=("/session/login.php");
                alert("No account");
            <?php } ?>
            var a = window.location.href=("backend/opinion.php?mod=<?php echo $mod_id?>&status="+opi);
        }
    </script>
</html>