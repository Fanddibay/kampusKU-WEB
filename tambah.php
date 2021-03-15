<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

if (isset($_POST["submit"])) {


    if (data($_POST) > 0) {
        echo "
        <script>
        alert('Data Berhasil di Tambahkan!');
        document.location.href='index.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Data Gagal di Tambahkan!');
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
    <title>Tambah Data</title>
    <link rel="stylesheet" href="bootstrap-v4/css/bootstrap.min.css">
</head>

<style>
    body {
        background-image: url(gambar/kerjasama2.svg);
        background-repeat: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-size: 100vh;
    }

    li {
        overflow: hidden;
    }

    .form-tambah {
        margin-left: -40px;
    }


    .br-text {
        margin-left: 70px;
        color: white;
    }

    .tombol {
        margin-left: 4rem;
    }

    .form-daftar {
        margin-left: -20px;
    }

    .tombol-tambah {
        margin-left: 84px;
        width: 8rem;
    }

    .form-card {
        opacity: 0.9;
    }
</style>

<body>


    <h1 class="mt-5 d-flex justify-content-center ">Daftar Kampus</h1>
    <div class="container d-flex justify-content-center ">
        <div class="card border-secondary px-4 py-4 form-card" style="width: 19rem;">
            <form action="" method="POST" enctype="multipart/form-data" class="form-action form-daftar border-top-10 border-bottom-10">
                <div class="breadcrumb bg-primary ml-4 "><span class="br-text">Silahkan Isi!</span></div>
                <hr>
                <ul>
                    <li>
                        <label for="nama">Nama : </label>
                        <input type="text" name="name" id="nama" autocomplete="off" class="form-control" autofocus required>
                    </li>
                    <li>
                        <label for="location">Lokasi : </label>
                        <input type="text" name="location" id="lokasi" class="form-control" autocomplete="off" required>
                    </li>
                    <li>
                        <label for="rank">Rank : </label>
                        <input type="text" name="rank" id="rank" class="form-control" autocomplete="off" required>
                    </li>
                    <li>
                        <label for="jumlah">Jumlah : </label>
                        <input type="text" name="total" id="jumlah" class="form-control" autocomplete="off" required>
                    </li>
                    <li>
                        <label for="gambar">Gambar : </label>
                        <input type="file" name="gambar" id="gambar" autocomplete="off" required>
                    </li>
                </ul>
                <button type="submit" name="submit" class="btn btn-success tombol tombol-tambah mt-4">Tambahkan!</button>
            </form>
            <a href="index.php" class="tombol btn btn-warning mt-4 w-50 exit">exit</a>
        </div>
    </div>

    </div>




    <link rel="stylesheet" href="bootstrap-v4/js/bootstrap.min.js">
</body>

</html>