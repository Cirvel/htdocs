<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:session/index.php?msg=none");
} else if (!$_SESSION['id']) {
    header("location:session/logout.php");
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
        <a href="index.php" class="selected">HOME</a>
        <a href="payment.php">PEMBAYARAN</a>
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
    <div class="indented">
        <!-- <h1>Pembayaran SPP</h1> -->
        <h1>Welcome,
            <?php echo $_SESSION['level'] . " " . $_SESSION['name']; ?>.
        </h1>
        <hr>
        <h3>Pembayaran</h3>
        <p>Laporkan data pembayaran, serta cetak peristiwa SPP siswa.</p>
        <p>Laporan tidak akan ditampilkan ketika SPP, Siswa, atau Petugasnya dihapus.</p>
        <h3>SPP</h3>
        <p>Tambah SPP baru dengan tahun dan nominal yang butuh dibayar.</p>
        <?php
        if ($_SESSION['level'] == "admin") {
            echo "
                <h3>Siswa</h3>
                <p>Tambah siswa baru, dengan kelas dan spp yang dibayar.</p>
                <p>Siswa tidak akan ditampilkan ketika kelasnya dihapus.</p>
                <h3>Kelas</h3>
                <p>Tambah kelas baru dengan kompetensi keahlian.</p>
                <h3>Petugas</h3>
                <p>Tambah petugas atau admin baru.</p>
            ";
        }
        ?>
    </div>
</body>

</html>