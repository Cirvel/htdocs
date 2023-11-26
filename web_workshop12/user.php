<?php 
	session_start();

    include("backend/connection.php"); // Connect to database

    if (!$_GET['id'] && isset($_SESSION['id'])){
        // If entered with no method but are logged in, then open own user's profile
        header('Location: user.php?id='. $_SESSION['id']);
    } else if (!$_GET['id']) { // If no method and not logged in, open first profile id
        header('Location: user.php?id=1');
    } else {
        $userid = $_GET['id'];
        $sql = mysqli_query($connection,"SELECT * FROM user WHERE user_id='$userid'");
        $data = $sql->fetch_assoc();
    } // May be replaced with users tab, where random user will be shown

    $status = false; // check if session exists

    if(isset( $_SESSION["status"]) && $_SESSION["status"] == "login"){
        $status = true;
    }

    
?>

<!DOCTYPE html>

<html>
    <head>
        <title><?php echo $data['nickname']
        ?> - Lithematics
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
                    <a href="library.php"><button class="btn-inv" >LIBRARY</button></a>
                    <!-- <a href="contact.php"><button class="btn-inv">CONTACT</button></a> -->
                    <?php
                        if($status){
                            echo "<a href='user.php'><button class='btn-inv selected' id='user' title='". $_SESSION['nickname'] ."'". $_SESSION['nickname'] ."'>".$_SESSION['nickname']."</button></a>";
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
        <div class="container-user">
            <?php
                if($status){
                    echo " <a href='contact.php?baduser=". $userid ."'><button class='btn-red'><i class='fa fa-flag'></i> Report User</button></a>";
                    if ($_SESSION['id']== $userid){
                        // If the viewer user id is the same as the id in user, enable editing
                        echo " <a href='edituser.php?id=".$userid."'><button><i class='fa fa-cog'></i> Edit User</button></a>";
                        if ($_SESSION['id']== $userid && $_SESSION['level']=="admin"){
                            // If the viewer user id is same and is level admin, enable dashboard
                            echo " <a href='dashboard'><button class='btn-orange'><i class='fa fa-wrench'></i> Dashboard</button></a>";
                        }
                        echo "<hr>";
                    }
                }
            ?>
            <div class="profile-stats">
                <div class="profile-icon">
                    <img src="assets/images/user_icon/<?php echo $data['picture'] ?>" alt="profile picture" title="Profile picture">
                    <h1 title="Nickname">
                        <?php echo $data['nickname'] ?>
                    </h1>
                </div>
                <table>
                    <tr title="Username are how the database find accounts through">
                        <th>Username</th>
                        <td>|</td>
                        <td><?php echo $data['username'] ?></td>
                    </tr>
                    <tr title="The date when the account were first registered">
                        <th>Register Date</th>
                        <td>|</td>
                        <td><?php echo $data['date_register'] ?></td>
                    </tr>
                    <tr title="General location of the user">
                        <th>Address</th>
                        <td>|</td>
                        <td><address><?php echo $data['address'] ?></address></td>
                    </tr>
                    <tr title="The power of the user they have on website">
                        <th>Level</th>
                        <td>|</td>
                        <td><?php echo $data['level'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="profile-desc">
                <table>
                    <tr>
                        <th>Description
                        <hr></th>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo $data['bio'];
                            ?>
                        </td>
                    </tr>
                </table>
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
</html>