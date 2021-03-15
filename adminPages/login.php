<?php
session_start();
require 'functions.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    // mengambil
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // mengambil username id

    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}


if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}


// jika ada 
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // sesuaikan dengan database
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username =  '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        // cek password
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;

            // cek remember me
            if (isset($_POST['remember'])) {

                // set cookie
                setcookie('id', $row['id'], time() + 3600);
                setcookie('key', hash('sha256', $row['username']), time() + 1800);
            }
            // masuk ke index
            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap-v4/css/bootstrap.min.css">
</head>

<style>
    body {
        background-image: url(gambar/login.svg);
        background-repeat: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-size: 100vh;
    }

    .form-card {
        opacity: 0.9;
    }
</style>

<body>


    <main>
        <div class="container d-flex justify-content-center mt-5 pt-5">
            <form action="" method="post">
                <div class="card border-secondary px-5 py-5 form-card">
                    <h4 class="d-flex justify-content-center">Login</h4>
                    <hr>
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" autocomplete="off" autofocus required>
                    </div>
                    <div class="form-group">
                        <input type="Password" class="form-control" id="Password" placeholder="Password" name="password" autocomplete="off" required>
                    </div>
                    <?php if (isset($error)) : ?>
                        <p style="color: red; font-style:italic;" class="d-flex justify-content-center mb-3"> Username atau Password Salah!</p>
                    <?php endif; ?>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                    </div>
                    <hr class="pb-3 mb-3">
                    <button type="submit" name="login" class="btn btn-primary d-flex justify-content-center w-100">Login</button>
                    <br>
                    <button type="reset" name="reset" class="btn btn-warning">Reset</button>
                    <br>
                    <a href="register.php" class="d-flex justify-content-center">
                        Create Account
                    </a>
                </div>
            </form>
        </div>
    </main>


    <script src="bootstrap-v4/js/bootstrap.min.js"></script>
</body>

</html>