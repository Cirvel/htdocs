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
        <form class="container-form" method="post" action="../backend/account_register.php" enctype="multipart/form-data">
            <div class="form-body">
                <table>
                    <h3>REGISTER</h3>
                <tr>
                    <td>Profile Picture</td>
                    <td>:</td>
                    <td><input type="file" name="pngPicture" id="pngPicture" accept=".png,.jpg,.jpeg" required></td>
                </tr>
                <tr>
                    <td colspan="3"><input type="text" name="nickname" id="nickname" placeholder="Nickname" required></td>
                </tr>
                <tr>
                    <td colspan="3"><input type="text" name="username" id="username" placeholder="Username" required></td>
                </tr>
                <tr>
                    <td colspan="3"><input type="text" name="password" id="password" placeholder="Password" required></td>
                </tr>
                <tr>
                    <td colspan="3"><input type="email" name="email" id="email" placeholder="Email" required></td>
                </tr>
                <tr>
                    <td colspan="3"><textarea name="bio" id="bio" cols="30" rows="10" placeholder="Bio, Describe yourself!" required></textarea></td>
                </tr>
                <tr>
                    <td colspan="3"><textarea name="address" id="address" cols="30" rows="2" placeholder="Address" required></textarea></td>
                </tr>
            </table>
            <input type="submit" class="btn-inv">
            <a href="login.php" class="linked">Already own an account?</a>
        </div>
        </form>
    </body>
</html>