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
        <form method="post" action="../backend/payment_add.php">
            <div class="form-body">
                <a href="payment_insert.php"><button type="button" class="delete">Back</button></a>
                <h3>TAMBAH PEMBAYARAN</h3>
                <input type="number" name="petugas" id="petugas" value="<?php echo $_SESSION['id'] ?>" hidden>
                <table>
                    <tr>
                        <td><label for="nisn">Siswa</label></td><td><label for="nisn">:</label></td>
                        <td>
                            <?php
                            $nisn = $_GET['nisn'];
                            $siswa_sql = mysqli_query($connection,"SELECT * FROM siswa WHERE nisn=$nisn")->fetch_assoc();
                            ?>
                            <input type="text" name="nisn" id="nisn" value="<?php echo $_GET['nisn'] ?>" hidden>
                            <input type="text" name="nama" id="nama" value="<?php echo $siswa_sql['nama'] ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="date">Tanggal Dibayar</label></td><td><label for="date">:</label></td>
                        <td>
                           <input type="date" name="date" id="date" value="<?php echo $_GET['date'] ?>" readonly><br>
                        </td>
                    </tr>
                    <tr>

                        <td><label for="bulan_dibayar">Bulan Dibayar</label></td><td><label for="bulan_dibayar">:</label></td>
                        <td>
                            <select name="bulan_dibayar" id="bulan_dibayar">
                                <!-- First check for student then if the month name is same, if both are true, disable it, else leave it alone -->
                                <!-- after ? is condition. first quote are if true, latter is if false. -->
                                <option value="Januari"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Januari'")->fetch_assoc();
                                echo $test ? 'disabled' : ''?>>Januari</option>
                                <option value="Februari"    
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Februari'")->fetch_assoc();
                                echo $test ? 'disabled' : ''?>>Februari</option>
                                <option value="Maret"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Maret'")->fetch_assoc();
                                echo $test ? 'disabled' : ''?>>Maret</option>
                                <option value="April"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='April'")->fetch_assoc();
                                echo $test ? 'disabled' : ''?>>April</option>
                                <option value="Mei"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Mei'")->fetch_assoc();
                                echo $test ? 'disabled' : ''?>>Mei</option>
                                <option value="Juni"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Juni'")->fetch_assoc();
                                echo $test ? 'disabled' : ''?>>Juni</option>
                                <option value="Juli"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Juli'")->fetch_assoc();
                                echo $test ? 'disabled' : ''?>>Juli</option>
                                <option value="Agustus"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Agustus'")->fetch_assoc();
                                echo $test ? 'disabled' : ''?>>Agustus</option>
                                <option value="September"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='September'")->fetch_assoc();
                                echo $test ? 'disabled' : ''?>>September</option>
                                <option value="Oktober"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Oktober'")->fetch_assoc();
                                echo $test ? 'disabled' : ''?>>Oktober</option>
                                <option value="November"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='November'")->fetch_assoc();
                                echo $test ? 'disabled' : ''?>>November</option>
                                <option value="Desember"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Desember'")->fetch_assoc();
                                echo $test ? 'disabled' : ''?>>Desember</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <?php
                $id_spp = $siswa_sql['id_spp'];
                $spp_sql = mysqli_query($connection,"SELECT * FROM siswa JOIN spp ON spp.id_spp=$id_spp")->fetch_assoc();
                ?>
                <input type="number" name="tahun_dibayar" id="tahun_dibayar" placeholder="Tahun Dibayar" value="<?php echo $spp_sql['tahun'] ?>" title="Tahun SPP" readonly>
                <input type="number" name="jumlah_bayar" id="jumlah_bayar" placeholder="Jumlah Bayar (Rupiah)" required>
                <hr>
                <button type="submit" class="add">Submit</button>
            </div>
        </form>
    </body>
</html>