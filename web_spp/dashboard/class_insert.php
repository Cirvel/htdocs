<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:session/index.php?msg=none");
	}
	if($_SESSION['level']!="admin"){ // if account is not admin
		header("location:index.php");
	}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Le l'achat Sort-Pierre-a-Pied</title>
        <link rel="stylesheet" href="../assets/style.css">
        <link rel="icon" href="../assets/region_specialty_intellectual_centre.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <!-- Navigation Bar -->
        <!-- <nav id="navbar">
            <img src="assets/region_specialty_intellectual_centre_50x50.png" alt="">
            <a href="class.php"><button>RETURN</button></a>
            <a href="session/logout.php"><button id="logout">LOGOUT</button></a>
        </nav> -->
        <!-- Content -->
        <form method="post" action="../backend/class_add.php">
            <div class="form-body">
                <a href="class.php"><button type="button" class="delete">Return</button></a>
                <h3>TAMBAH KELAS</h3>
                <input type="text" name="nama_kelas" id="nama_kelas" placeholder="Nama Kelas" required>
                <input type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" placeholder="Kompetensi Keahlian" required>
                <hr>
                <button type="submit" class="add">Submit</button>
            </div>
        </form>
    </body>
</html>