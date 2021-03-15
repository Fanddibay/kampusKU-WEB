<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
$kampusku = query("SELECT * FROM kampusku ORDER BY id ASC");

// jika nanti tombol cari di click
if (isset($_POST["search"])) {
    $kampusku = search($_POST["keyword"]);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KampusKu</title>
    <link rel="stylesheet" href="bootstrap-v4/css/bootstrap.min.css">
</head>

<style>
    body {
        background-image: url(gambar/kampus.svg);
        background-repeat: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-size: 100vh;
        background-color: whitesmoke;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        padding-top: 20px;
        color: maroon;


    }

    .utama {
        background-image: url(gambar/invit.svg);
        background-repeat: repeat;
        background-position-x: center;
        background-position-y: center;
        background-size: 50vh;
        background-color: whitesmoke;
        opacity: 0.7;
    }


    a {
        text-decoration: none;
        color: red;
    }

    td {
        color: maroon;
        font-weight: bold;
    }

    .tambahkan {
        margin-bottom: -20px;
    }

    .exit {
        width: 200px;
    }
</style>

<body>

    <div class="jumbotron utama">
        <h1>Daftar Kampus</h1>
    </div>



    <div class="row float-md-right tambahkan">
        <div class="col-auto float-left">
            <form action="" method="post">
                <div class="input-group-append">
                    <input type="text" name="keyword" aria-label="Recipient's username" placeholder="Silahkan Cari" size="50" class="form-control" autofocus autocomplete="off" aria-describedby="basic-addon2">
                    <button type="submit" name="search" class="tombol-cari btn btn-primary w-50">Cari</button>
                </div>
            </form>
        </div>
        <div class="col-auto  ">
            <a href="tambah.php" class="float-right btn btn-warning  position-relative">+ Tambah data Kampus</a>
        </div>
    </div>
    <br>
    <br>
    <table border="1" cellpadding="10" cellspacing="0" class="table">

        <thead class="thead-dark">
            <tr>
                <span>
                    <th>No.</th>
                </span>
                <th scope="col">Aksi</th>
                <th scope="col">Nama Universitas</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Rank</th>
                <th scope="col">Jumlah Mahasiswa</th>
                <th scope="col">Gambar</th>
            </tr>
        </thead>
        <?php $i = 1; ?>
        <?php foreach ($kampusku as $row) : ?>
            <tr>
                <td> <?= $i; ?> </td>
                <td>
                    <a href="ubah.php?id=<?= $row["id"]; ?>" class="btn btn-success">Ubah Data</a> |
                    <a href="hapus.php?id=<?= $row["id"]; ?> 
                    " onclick=" return confirm('yakin?');" class="btn btn-danger ">Hapus Data</a>
                </td>
                <td><?= $row["name"]; ?></td>
                <td><?= $row["location"]; ?></td>
                <td><?= $row["rank"]; ?></td>
                <td><?= $row["total"]; ?></td>
                <td>
                    <img src="gambar/<?= $row["gambar"]; ?> " width=" 200px">
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
    <a href="logout.php" class="float-right btn btn-danger mr-auto exit float-md-left">Exit</a>
    <script src="bootstrap-v4/js/bootstrap.min,js"></script>
</body>



</html>