<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:session/index.php?msg=none");
	}
	if($_SESSION['level']!="admin"){ // if account is not admin, return to index
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
        <nav id="navbar">
            <a href="index.php">HOME</a>
            <a href="payment.php">PEMBAYARAN</a>
            <a href="spp.php">SPP</a>
            <?php
                if($_SESSION['level']=="admin"){
                    echo "
                    <a href='students.php'>SISWA</a>
                    <a href='class.php' class='selected'>KELAS</a>
                    <a href='employee.php'>PETUGAS</a>
                    ";
                }
            ?>
            <a href="session/logout.php">LOGOUT</a>
        </nav>
        <!-- Content -->
        <table id="data-table">
            <a href="class_insert.php"><button class="add indented">Tambah Kelas</button></a>
            <hr>
            <thead>
                <tr>
                    <th style="width: 2ch">No</th>
                    <th>Kelas</th>
                    <th>Kompetensi Kehalian</th>
                    <th style="width: 5ch;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("../backend/connection.php"); // Connect to database
                $no = 1; // Ordering number
                $sql = mysqli_query($connection,"SELECT * FROM kelas ORDER BY id_kelas"); // Create statement
                while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['nama_kelas'] ?></td>
                        <td><?php echo $data['kompetensi_keahlian'] ?></td>
                        <td class="actions">
                            <a href="class_edit.php?id=<?php echo $data['id_kelas'] ?>"><button class="edit">Edit</button></a>
                            <a href="../backend/class_remove.php?id=<?php echo $data['id_kelas'] ?>"><button class="delete">Delete</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>