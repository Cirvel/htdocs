<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:session/index.php?msg=none");
}
include '../backend/connection.php';

$nisn = $_GET['id'];
$siswa = mysqli_query($connection, "SELECT * FROM siswa JOIN kelas ON kelas.id_kelas = siswa.id_kelas WHERE nisn=$nisn")->fetch_assoc();
?>

<!DOCTYPE html>

<html>

<head>
    <title>Le l'achat Sort-Pierre-a-Pied</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="icon" href="../assets/region_specialty_intellectual_centre.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/download.js"></script>
</head>

<body>
    <!-- Navigation Bar -->
    <nav id="navbar">
        <a href="index.php">HOME</a>
        <a href="payment.php" class="selected">PEMBAYARAN</a>
        <a href="spp.php">SPP</a>
        <?php
        if ($_SESSION['level'] == "admin") {
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
    <a href="payment.php"><button class="delete indented">Back</button></a>
    <a href="payment_print.php?id=<?php echo $siswa['nisn'];?>" target="_blank"><button class="print indented">Cetak</button></a>
    <hr>
    <!-- <div id="pdf"> -->
    <table id="data-table" class="table-roles">
        <h2 class="indented">
            <?php echo $siswa['nama'] . " | " . $siswa['nama_kelas'] ?>
        </h2>
        <thead>
            <tr>
                <th style="width: 2ch">No</th>
                <th>Petugas</th>
                <th>Tanggal Bayar</th>
                <th>Bulan Bayar</th>
                <th>Tahun Bayar</th>
                <th>Nominal</th>
                <th>Jumlah Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("../backend/connection.php"); // Connect to database
            $no = 1; // Ordering number
            $sql = mysqli_query($connection, "SELECT * FROM pembayaran AS a JOIN petugas AS b ON b.id_petugas = a.id_petugas JOIN siswa AS c ON c.nisn = a.nisn JOIN spp AS d ON d.id_spp = a.id_spp WHERE a.nisn = $nisn"); // Create statement
            while ($data = mysqli_fetch_array($sql)) {
                ?>
                <tr>
                    <td>
                        <?php echo $no++ ?>
                    </td>
                    <td>
                        <?php echo $data['nama_petugas'] ?>
                    </td>
                    <td>
                        <?php echo $data['tgl_bayar'] ?>
                    </td>
                    <td>
                        <?php echo $data['bulan_dibayar'] ?>
                    </td>
                    <td>
                        <?php echo $data['tahun_dibayar'] ?>
                    </td>
                    <td>
                        <?php echo "Rp." . number_format($data['nominal'], 2) ?>
                    </td>
                    <td>
                        <?php echo "Rp." . number_format($data['jumlah_bayar'], 2) ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- </div> -->
</body>

</html>