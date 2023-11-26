<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:session/index.php?msg=none");
	}
    include '../backend/connection.php';


    $id = $_GET['id']; // backend/class_remove.php?id=$id
    $data = mysqli_query($connection,"SELECT * FROM pembayaran WHERE id_pembayaran = $id");
    $fetchy = $data->fetch_assoc();

    $nisn = $fetchy['nisn']; // backend/class_remove.php?id=$id
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
        <form method="post" action="../backend/payment_update.php">
            <div class="form-body">
                <a href="payment.php"><button type="button" class="delete">Return</button></a>
                <h3>TAMBAH PEMBAYARAN</h3>
                <input type="number" name="id" id="id" value="<?php echo $id ?>" hidden>
                <input type="number" name="petugas" id="petugas" value="<?php echo $_SESSION['id'] ?>" hidden>
                <table>
                    <tr>
                        <td><label for="nisn">Siswa</label></td><td><label for="nisn">:</label></td>
                        <td>
                            <?php $siswasql = mysqli_query($connection,"SELECT * FROM siswa JOIN pembayaran ON pembayaran.nisn = siswa.nisn WHERE siswa.nisn = $nisn")->fetch_assoc(); ?>
                            <input type="text" name="nisn" id="nisn" value="<?php echo $fetchy['nisn'] ?>" hidden>
                            <input type="text" name="nama" id="nama" value="<?php echo $siswasql['nama'] ?>" readonly>
                            <!-- <?php $hifumi = $fetchy['nisn'] ?>
                            <select name="nisn" id="nisn" readonly>
                                <?php
                                include("backend/connection.php"); // Connect to database
                                $sql = mysqli_query($connection,"SELECT * FROM siswa"); // Create statement
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                <option value="<?php echo $data['nisn'] ?>" <?php echo $hifumi == $data['nisn'] ? 'selected="selected"' : '' ?> ><?php echo $data['nama']?></option>
                                <?php } ?>
                            </select> -->
                        </td>
                    </tr>
                    <tr>
                        <td><label for="date">Tanggal Dibayar</label></td><td><label for="date">:</label></td>
                        <td>
                           <input type="date" name="date" id="date" value="<?php echo $fetchy['tgl_bayar'] ?>" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="bulan_dibayar">Bulan Dibayar</label></td><td><label for="bulan_dibayar">:</label></td>
                        <td>
                            <?php $daisuki = $fetchy['bulan_dibayar'] ?>
                            <select name="bulan_dibayar" id="bulan_dibayar" title="Original data: <?php echo $fetchy['bulan_dibayar'];?>">
                                <!-- Kondisi pertama mencari sisawa, kemudian cari bulan dibayar yang sama dengan bulan, ketika ketemu, akan disable -->
                                <!-- Kondisi kedua ketika bulan dibayar yang di edit sama dengan bulan tersebut, enable saja (Akan tetap disable ketika menambah pembayaaran baru) -->
                                <option value="Januari"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Januari'")->fetch_assoc();
                                echo $test && $fetchy['bulan_dibayar'] !== "Januari" ? 'disabled' : ''?>>Januari</option>
                                <option value="Februari"    
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Februari'")->fetch_assoc();
                                echo $test && $fetchy['bulan_dibayar'] !== "Februari" ? 'disabled' : ''?>>Februari</option>
                                <option value="Maret"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Maret'")->fetch_assoc();
                                echo $test && $fetchy['bulan_dibayar'] !== "Maret" ? 'disabled' : ''?>>Maret</option>
                                <option value="April"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='April'")->fetch_assoc();
                                echo $test && $fetchy['bulan_dibayar'] !== "April" ? 'disabled' : ''?>>April</option>
                                <option value="Mei"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Mei'")->fetch_assoc();
                                echo $test && $fetchy['bulan_dibayar'] !== "Mei" ? 'disabled' : ''?>>Mei</option>
                                <option value="Juni"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Juni'")->fetch_assoc();
                                echo $test && $fetchy['bulan_dibayar'] !== "Juni" ? 'disabled' : ''?>>Juni</option>
                                <option value="Juli"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Juli'")->fetch_assoc();
                                echo $test && $fetchy['bulan_dibayar'] !== "Juli" ? 'disabled' : ''?>>Juli</option>
                                <option value="Agustus"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Agustus'")->fetch_assoc();
                                echo $test && $fetchy['bulan_dibayar'] !== "Agustus" ? 'disabled' : ''?>>Agustus</option>
                                <option value="September"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='September'")->fetch_assoc();
                                echo $test && $fetchy['bulan_dibayar'] !== "September" ? 'disabled' : ''?>>September</option>
                                <option value="Oktober"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Oktober'")->fetch_assoc();
                                echo $test && $fetchy['bulan_dibayar'] !== "Oktober" ? 'disabled' : ''?>>Oktober</option>
                                <option value="November"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='November'")->fetch_assoc();
                                echo $test && $fetchy['bulan_dibayar'] !== "November" ? 'disabled' : ''?>>November</option>
                                <option value="Desember"
                                <?php $test = mysqli_query($connection,"SELECT bulan_dibayar FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='Desember'")->fetch_assoc();
                                echo $test && $fetchy['bulan_dibayar'] !== "Desember" ? 'disabled' : ''?>>Desember</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <input type="number" name="tahun_dibayar" id="tahun_dibayar" placeholder="Tahun Dibayar" value="<?php echo $fetchy['tahun_dibayar'] ?>" title="Tahun SPP" readonly>
                <input type="number" name="jumlah_bayar" id="jumlah_bayar" placeholder="Jumlah Bayar (Rupiah)" value="<?php echo $fetchy['jumlah_bayar'] ?>" required>
                <hr>
                <button type="submit" class="add">Submit</button>
            </div>
        </form>
    </body>
</html>