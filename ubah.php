<?php
session_start();
// cek apakah sudah login
if (!isset($_SESSION["login"])) {
    // tendang ke halaman login
    header("Location: login.php");
    exit;
}
require 'functions.php';

// ambil data di rul
$id = $_GET["id"];

// query data mahasiswa
$kps = query("SELECT * FROM kampusku WHERE id = $id")[0];

// cek apakah tombl submit udah dipencet apa blom?
if (isset($_POST["submit"])) {
    // cek apakah data berhasil diubah?
    if (ubah($_POST) > 0) {
        echo "
        <script>
        alert('Data Berhasil di Ubah!');
        document.location.href='index.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Data Gagal di Ubah!');
        document.location.href='index.php';
        </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <link rel="stylesheet" href="bootstrap-v4/css/bootstrap.min.css">
</head>

<style>
    body {
        background-image: url(gambar/invit.svg);
        background-repeat: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-size: 100vh;

    }

    li {
        overflow: hidden;
    }

    .tombol {
        margin-left: 4rem;
    }



    .br-text {
        margin-left: 70px;
        color: white;
    }

    .form-card {
        opacity: 0.9;
    }
</style>

<body>


    <h1 class="mt-3 container d-flex justify-content-center ">Ubah Data <br> Mahasiswa</h1>
    <div class="container d-flex justify-content-center ">
        <div class="card border-secondary px-4 py-4 form-card" style="width: 19rem;">
            <div class="breadcrumb bg-primary"><span class="br-text">Silahkan Isi</span></div>
            <hr>
            <form action="" method="POST" enctype="multipart/form-data" class="form-action border-bottom-10 border-top-10">
                <ul>
                    <input type="hidden" name="id" value="<?= $kps["id"]; ?>">
                    <input type="hidden" name="gambarLama" value="<?= $kps["gambar"]; ?>">

                    <li>
                        <label for="nama">Nama : </label>
                        <input type="text" name="name" autocomplete="off" id="nama" required="" value="<?= $kps["name"]; ?>">
                    </li>
                    <li>
                        <label for="nama">Lokasi : </label>
                        <input type="text" name="location" autocomplete="off" id="lokasi" required autocomplete="off" value="<?= $kps["location"]; ?>">
                    </li>
                    <li>
                        <label for="nama">Rank : </label>
                        <input type="text" name="rank" autocomplete="off" id="rank" required value="<?= $kps["rank"]; ?>">
                    </li>
                    <li>
                        <label for=" nama">Jumlah : </label>
                        <input type="text" name="total" autocomplete="off" id="jumlah" required value="<?= $kps["total"]; ?>">
                    </li>
                    <li>
                        <label for=" nama" class="mt-4">Gambar : </label>
                        <img src="gambar/<?= $kps['gambar']; ?>" alt="" width="170px" class="py-4 ml-2">
                        <input type="file" name="gambar" autocomplete="off" id="gambar">
                    </li>
                </ul>
                <button type=" submit" name="submit" class="btn btn-success w-100 mt-4 ">Ubah!</button>
            </form>
            <a href="index.php" class="btn btn-warning mt-4 w-100">exit</a>
        </div>
    </div>





    <link rel="stylesheet" href="bootstrap-v4/js/bootstrap.min.js">
</body>

</html>