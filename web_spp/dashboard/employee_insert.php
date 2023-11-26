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
        <!-- Content -->
        <form method="post" action="../backend/employee_add.php">
            <div class="form-body">
                <a href="employee.php"><button type="button" class="delete">Return</button></a>
                <h3>TAMBAH PETUGAS</h3>
                <input type="text" name="name" id="name" placeholder="Nama Petugas" required>
                <input type="text" name="username" id="name" placeholder="Username" required>
                <input type="text" name="password" id="password" placeholder="Password" required>
                <label for="level">Level :</label>
                <select name="level" id="level">
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                </select>
                <hr>
                <button type="submit" class="add">Submit</button>
            </div>
        </form>
    </body>
</html>