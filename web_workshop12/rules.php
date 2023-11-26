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
                    <a href="library.php"><button class="btn-inv" >LIBRARY</button></a>
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
        <div class="form-body">
            <h1>RULES</h1>
            <p>Rules are an important aspect in any community to keep order and be civilised, any failure to abide may result in account supension or ban.</p>
            <hr>
            <h2>Community Rules</h2>
            <p>Rules for user-to-user interaction.</p>
            <h3>- Be Polite</h3>
            <p>Nobody likes a jerk as much as us, please think before you speak!</p>
            <h3>- Hate Speech</h3>
            <p>We don't want SJWs knocking on our now, keep those white pointy mask at home people.</p>
            <hr>
            <h2>Mod Rules</h2>
            <h3>- Virus & Trojans</h3>
            <p>If any of your mods in the website contains any malware, immediate ban will ensue.</p>
            <h3>- Explicit Content</h3>
            <p>Any NSFW or Excessive Profanity in your mods may result in supension, up to a ban if repeated.</p>
            <h3>- Plagiarism</h3>
            <p>Having inspirations is good, but too much and you're just copying them, besides; would you like your mod you worked hard for be stolen?</p>
        </div>
        <div class="gap"></div>
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