<?php 
	session_start();

    $status = false; // check if session exists

    if(isset( $_SESSION["status"]) && $_SESSION["status"] == "login"){
        $status = true;
    }
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
    <header>
        <div class="header" style="position: fixed;">
            <a href="#">
                <div class="icon">
                        <img src="assets/images/icon_shadow.png" alt="icon">
                </div>
            </a>
            <div class="nav-list">
                <nav>
                    <a href="index.php"><button class="btn-inv selected">HOME</button></a>
                    <a href="library.php"><button class="btn-inv" >LIBRARY</button></a>
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
        <div class="background">
            <img id="img3" class="nope" src="assets/images/games/shogun2.jpg" alt="">
        </div>
        
        <div class="banner" id="p1">
            <!-- <span class="image fit primary"><img src="assets/images/games/aw.jpg" alt="" /></span> -->
            <!-- <img src="assets/images/games/aw.jpg" alt=""> -->
            <div class="text">
                <h1>FROM THE COMMUNITY, FOR THE COMMUNITY</h1>
                <h3>Our mods are made to increase the replayability of their respective games by fans.</h3>
            </div>
        </div>

        <div class="banner" id="p2">
            <!-- <span class="image fit primary"><img src="assets/images/games/shogun2.jpg" alt="" /></span> -->
            <!-- <img src="assets/images/games/shogun2.jpg" alt=""> -->
            <div class="text">
                <h1>VARIETY OF MODS</h1>
                <h3>Ranging from simple quality-of-life to full blown overhaul!</h3>
            </div>
        </div>
        
        <div class="banner special" id="p3">
            <!-- <span class="image fit primary"><img src="assets/images/games/fots.jpg" alt="" /></span> -->
            <!-- <img src="assets/images/games/fots.jpg" alt=""> -->
            <div class="text">
                <h1>MANY GAMES</h1>
                <h3>As long as it is singleplayer or local multiplayer, there will be mods for it.</h3>
            </div>
        </div>

        <div class="banner" id="p4">
            <!-- <span class="image fit primary"><img src="assets/images/games/mc-landscape.webp" alt="" /></span> -->
            <!-- <img src="assets/images/games/fots.jpg" alt=""> -->
            <div class="text" style="margin-bottom: 5pc;">
                <h1>DOWNLOAD NOW</h1>
                <h3>Show some support for the modders, and maybe become a modder yourself!</h3>
                <a href="library.php">
                    <button>
                        <h3>DISCOVER MODS</h3>
                    </button>
                </a>
            </div>
        </div>
    </body>
    <br>
    <script>
        window.onscroll = function()
{
   // var img1 = document.getElementById('img1').classList;
   // var img2 = document.getElementById('img2').classList;
   // var img3 = document.getElementById('img3').classList;

    var p1 = document.getElementById("p1");
    var p2 = document.getElementById("p2");
    var p3 = document.getElementById("p3");
    var p4 = document.getElementById("p4");

    // if page is below the element
    
    if ( window.scrollY > p4.offsetTop ) {
      document.getElementById("img3").src = "assets/images/games/shogun2.jpg";
    } else if (window.scrollY > p3.offsetTop ) {
      document.getElementById("img3").src = "assets/images/games/fots.jpg";
    } else if (window.scrollY > p2.offsetTop ) {
      document.getElementById("img3").src = "assets/images/games/aw.jpg";
    } else if (window.scrollY > p1.offsetTop ) {
      document.getElementById("img3").src = "assets/images/games/shogun2.jpg";
    }
}
    </script>
</html>