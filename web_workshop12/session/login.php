<!DOCTYPE html>

<html>
    <head>
        <title>Lithematics</title>
        <link rel="icon" href="../assets/images/icon.png">
        <link rel="stylesheet" href="../assets/css/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
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
                <!-- <a href="news.html" title="News"><button class="btn-inv"><i class="fa fa-bell"></i></button></a> -->
                <nav>
                    <a href="../index.php"><button class="btn-inv">HOME</button></a>
                </nav>
                <div class="hamburger">
                    <i class="fa fa-navicon"></i>
                    <div class="dropdown">
                        <a href="../index.php">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Body -->
    <body>
        <div class="gap"></div>
        <!-- Mod List -->
        <form class="container-form" method="post" action="validate.php">
            <div class="form-body">
                <?php
                    if(isset($_GET['msg'])){ // Validation message
                        if($_GET['msg'] == "failed"){
                            echo "<p>Invalid username or password</p><hr>";
                        }else if($_GET['msg'] == "disconnected"){
                            echo "<p>Successfully disconnected</p><hr>";
                        }else if($_GET['msg'] == "none"){
                            echo "<p>Please login to enter website</p><hr>";
                        }else if($_GET['msg'] == "registered"){
                            echo "<p>Account successfully registered</p><hr>";
                        }
                }
                ?>
                <table>
                    <h3>LOGIN</h3>
                    <tr>
                        <td><input type="text" name="username" id="username" placeholder="Username" required></td>
                    </tr>
                    <tr>
                        <td><input type="password" name="password" id="password" placeholder="Password" required></td>
                    </tr>
                </table>
                <input type="submit" class="btn-inv">
                <a href="register.php" class="linked">Don't own an account?</a>
            </form>
        </div>
    </body>
</html>