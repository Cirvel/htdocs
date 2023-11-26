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

    $data = mysqli_query($connection,"SELECT * FROM petugas WHERE id_petugas = $id");
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
        <!-- Content -->
        <form method="post" action="../backend/employee_update.php">
            <div class="form-body">
                <a href="employee.php"><button type="button" class="delete">Return</button></a>
                <h3>EDIT PETUGAS</h3>
                <input type="number" name="id_petugas" id="id_petugas" value="<?php echo $fetchy['id_petugas'] ?>" hidden>
                <input type="text" name="nama_petugas" id="nama_petugas" placeholder="Nama Petugas" value="<?php echo $fetchy['nama_petugas'] ?>" required>
                <input type="text" name="username" id="name" placeholder="Username" value="<?php echo $fetchy['username'] ?>" required>
                <input type="text" name="password" id="password" placeholder="Password" value="<?php echo $fetchy['password'] ?>" required>
                <?php $hifumi = $fetchy['level']; ?>
                <label for="level">Level :</label>
                <select name="level" id="level">
                    <option value="admin" <?php echo $hifumi == 'admin' ? 'selected="selected"' : '' ?>>Admin</option>
                    <option value="petugas" <?php echo $hifumi == 'petugas' ? 'selected="selected"' : '' ?>>Petugas</option>
                </select>
                <hr>
                <button type="submit" class="add">Submit</button>
            </div>
        </form>
    </body>
</html>