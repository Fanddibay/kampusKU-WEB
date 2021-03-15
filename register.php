<?php

// CONECT TO FUNCTION
require 'functions.php';

if (isset($_POST["submit"])) {
    if (daftar($_POST) > 0) {
        echo "<script>
        alert('User Berhasil Ditambahkan!')
        document.location.href='login.php';
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}





// require 'functions.php';

// if (isset($_POST["register"])) {

//     if (registrasi($_POST) > 0) {
//         echo "<script>
//           alert('User Baru Berhasil Ditambahkan')
//         </script>";
//     } else {
//         echo mysqli_error(($conn));
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" href="bootstrap-v4/css/bootstrap.min.css">
</head>

<style>
    body {
        background-image: url(gambar/daftar.svg);
        background-repeat: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-size: 100vh;
    }

    .tombol {
        margin-left: 0.1rem;
    }

    .form-card {
        opacity: 0.9;
    }
</style>

<body>



    <div class="container d-flex justify-content-center mt-5 pt-5">
        <div class="card border-secondary px-5 py-5 form-card">
            <form action="" method="post">
                <div class="form-group">
                    <h4 class="d-flex justify-content-center">Create Account</h4>
                    <hr>

                    <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" autocomplete="off" autofocus required>
                </div>
                <div class="form-group">

                    <input type="Password" class="form-control" id="Password" placeholder="Password" name="Password" autocomplete="off" required>
                </div>
                <div class="form-group">

                    <input type="password" class="form-control" id="Password2" placeholder="Confirm Password" name="Password2" autocomplete="off" required>
                </div>
                <hr class="mb-3 pb-3">
                <button type="submit" name="submit" class="btn btn-primary tombol d-flex justify-content-center w-100">Register</button>
                <br>
                <a href="login.php" class="btn btn-warning d-flex justify-content-center w-100">
                    Back
                </a>
            </form>
        </div>
    </div>

    <script src="bootstrap-v4/js/bootstrap.min.js"></script>
</body>

</html>