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
                    <a href="library.php"><button class="btn-inv" >LIBRARY</button></a>
                    <!-- <a href="contact.php"><button class="btn-inv selected">CONTACT</button></a> -->
                    <?php
                        echo "<a href='user.php'><button class='btn-inv' id='user' title='". $_SESSION['nickname'] ."'>".$_SESSION['nickname']."</button></a>";
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
        <form method="post" class="container-form" action="backend/admin_contact.php">
            <div class="form-body">
                <?php
                if(isset($_GET['msg'])){ // Validation message
                    if($_GET['msg'] == "success"){
                        echo "<p>Message has been successfuly sent to the moderators.</p>";
                    } else {
                        echo "<p>Message failed to send.</p>";
                    }
                }

                // WIP, Get method then set them as default value for title and textarea
                $title = null;
                $content = null;
                $type = null;
                if(isset($_GET['badmod'])){
                    $bad = $_GET['badmod'];
                    $sql = mysqli_query($connection,"SELECT * FROM modfile JOIN user ON user.user_id = modfile.mod_id  WHERE modfile.mod_id = $bad")->fetch_assoc();
                    if ($sql) {
                        $title = $sql['title'];
                        $content= "'".$sql['title']."' by '@".$sql['username']."' is violating the rules by: ";
                        $type = "moderation";
                    }
                } else if (isset($_GET['baduser'])){
                    $bad = $_GET['baduser'];
                    $sql = mysqli_query($connection,"SELECT * FROM user WHERE user_id = $bad")->fetch_assoc();
                    if ($sql) {
                        $title = "@".$sql['username'];
                        $content= "'".$sql['nickname']."' is violating the rules by: ";
                        $type = "moderation";
                    }
                }

                ?>
                <h3>CONTACT</h3>
                <label for="purpose">Type of Message: </label>
                <select name="post_type" id="post_type">
                    <option <?php echo $type == "suggestion" ? "selected" : "" ?> value="suggestion" title="Suggest a cool feature we should add!">Suggestion</option>
                    <option <?php echo $type == "moderation" ? "selected" : "" ?> value="moderation" title="Report a troublemaker to us!">Moderation</option>
                    <option <?php echo $type == "bug" ? "selected" : "" ?> value="bug" title="Let us know about any oversight!">Bug Report</option>
                </select>
                <input type="text" name="title" id="title" placeholder="Title" value="<?php echo $title ?>" required>
                <textarea name="content" id="content" cols="100%" rows="10" placeholder="Reason"><?php echo $content ?></textarea>
                <input type="submit" class="btn-inv">
            </div>
        </form>
        <script src="assets/js/dhtml.js"></script>
    </body>
</html>