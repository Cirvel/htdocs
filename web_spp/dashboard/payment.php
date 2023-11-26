<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:session/index.php?msg=none");
	}
    include("../backend/connection.php"); // Connect to database
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
            <a href="payment.php" class="selected">PEMBAYARAN</a>
            <a href="spp.php">SPP</a>
            <?php
                if($_SESSION['level']=="admin"){
                    echo "
                    <a href='students.php'>SISWA</a>
                    <a href='class.php'>KELAS</a>
                    <a href='employee.php'>PETUGAS</a>
                    ";
                }
            ?>
            <a href="session/logout.php">LOGOUT</a>
        </nav>
        <!-- Content -->
        <table id="data-table" class="table-roles">
            <a href="payment_insert.php"><button class="add indented">Tambah Pembayaran</button></a> |
            <form method="get" action="payment_detail.php">
                <select name="id" id="id">
                    <?php
                $arch = mysqli_query($connection,"SELECT * FROM siswa JOIN kelas ON kelas.id_kelas = siswa.id_kelas ORDER BY nama"); // Create statement
                while ($ser = mysqli_fetch_array($arch)) {
                    ?>
                    <option value="<?php echo $ser['nisn'] ?>"><?php echo $ser['nama'] ?><?php echo " (". $ser['nama_kelas'] .")" ?></option>
                    <?php } ?>
                </select>
                -
                <button type="submit" class="detail">Lihat History</button>
            </form>
            <hr>
            <thead>
                <tr>
                    <th style="width: 2ch">No</th>
                    <th>Petugas</th>
                    <th>NISN</th>
                    <th>Tanggal Bayar</th>
                    <th>Bulan Bayar</th>
                    <th>Tahun Bayar</th>
                    <th>Nominal</th>
                    <th>Jumlah Bayar</th>
                    <th style="width: 5ch;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1; // Ordering number
                $sql = mysqli_query($connection,"SELECT * FROM pembayaran AS a JOIN petugas AS b ON b.id_petugas = a.id_petugas JOIN siswa AS c ON c.nisn = a.nisn JOIN spp AS d ON d.id_spp = a.id_spp ORDER BY id_pembayaran"); // Create statement
                while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['nama_petugas'] ?></td>
                        <td><?php echo $data['nisn'] . " (" . $data['nama'] . ")" ?></td>
                        <td><?php echo $data['tgl_bayar'] ?></td>
                        <td><?php echo $data['bulan_dibayar'] ?></td>
                        <td><?php echo $data['tahun_dibayar'] ?></td>
                        <td><?php echo "Rp." . number_format($data['nominal'],2) ?></td>
                        <td><?php echo "Rp." . number_format($data['jumlah_bayar'],2) ?></td>
                        <td class="actions">
                            <!-- <a href="payment_detail.php?id=<?php echo $data['nisn'] ?>"><button class="detail">Detail</button></a> -->
                            <a href="payment_edit.php?id=<?php echo $data['id_pembayaran'] ?>"><button class="edit">Edit</button></a>
                            <a href="../backend/payment_remove.php?id=<?php echo $data['id_pembayaran'] ?>"><button class="delete">Delete</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>