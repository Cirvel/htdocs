<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:session/login.php?msg=none");
	}

    $id = $_GET["id"];
    if(!$id && isset($_SESSION['id'])){
        // $id = $_SESSION["id"];
        // If no id method but logged in, edit own account instead.
        header("location:edituser.php?id=".$_SESSION['id']);
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
                </nav>
                <div class="hamburger">
                    <i class="fa fa-navicon"></i>
                    <div class="dropdown">
                        <a href="index.php">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Body -->
    <body>
        <div class="gap"></div>
        <form class="container-form" action="backend/account_update.php" method="post" enctype="multipart/form-data">
            <?php
            $sql = mysqli_query($connection,"SELECT * FROM user WHERE user_id = $id");
            $data = mysqli_fetch_assoc($sql);
            if (!$data) {
                // If failed to fetch user data, kick to index
                header("location:.");
            } else {
                if ($data['user_id'] != $_SESSION['id']) {
                    // If editor id is not the same as the edited id, kick to user
                    header("location:user.php?id=".$data['user_id']);
                }
            }
            ?>
            <div class="form-body">
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
                    <td colspan="3"><input type="text" name="username" id="username" placeholder="Username" value="<?php echo $data['username'] ?>" readonly></td>
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
            </table>
            <input type="submit" class="btn-inv">
        </div>
        </form>
    </body>
</html>