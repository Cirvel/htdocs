<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:session/index.php?msg=none");
	}
    include '../backend/connection.php';
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
        <form method="get" action="payment_insert2.php">
            <div class="form-body">
                <a href="payment.php"><button type="button" class="delete">Return</button></a>
                <h3>PILIH SISWA</h3>
                <!-- <input type="number" name="petugas" id="petugas" value="<?php echo $_SESSION['id'] ?>" hidden> -->
                <table>
                    <tr>
                        <td><label for="nisn">Siswa</label></td><td><label for="nisn">:</label></td>
                        <td>
                            <select name="nisn" id="nisn">
                                <?php
                                include("backend/connection.php"); // Connect to database
                                $sql = mysqli_query($connection,"SELECT * FROM siswa ORDER BY nama"); // Create statement
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                <option value="<?php echo $data['nisn'] ?>"><?php echo $data['nama']?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="date">Tanggal Dibayar</label></td><td><label for="date">:</label></td>
                        <td>
                           <input type="date" name="date" id="date" required><br>
                        </td>
                    </tr>
                </table>
                <hr>
                <button type="submit" class="add">Next</button>
            </div>
        </form>
    </body>
    <script>
        document.getElementById('date').valueAsDate = new Date(); // Set 'tanggal_dibayar' default input as current timestamp
    </script>
</html>