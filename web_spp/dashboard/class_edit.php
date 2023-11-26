<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:session/index.php?msg=none");
	}
	if($_SESSION['level']!="admin"){ // if account is not admin
		header("location:index.php");
	}
    include '../backend/connection.php';

    $id = $_GET['id']; // backend/class_remove.php?id=$id

    $data = mysqli_query($connection,"SELECT * FROM kelas WHERE id_kelas = $id");
    $fetchy = $data->fetch_assoc();
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
        <form method="post" action="../backend/class_update.php">
            <div class="form-body">
                <a href="class.php"><button type="button" class="delete">Return</button></a>
                <h3>EDIT KELAS</h3>
                <input type="number" name="id_kelas" id="id_Kelas" value="<?php echo $fetchy['id_kelas']?>" hidden>
                <input type="text" name="nama_kelas" id="nama_kelas" placeholder="Nama Kelas" value="<?php echo $fetchy['nama_kelas']?>" required>
                <input type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" placeholder="Kompetensi Keahlian" value="<?php echo $fetchy['kompetensi_keahlian']?>" required>
                <hr>
                <button type="submit" class="edit">Submit</button>
            </div>
        </form>
    </body>
</html>