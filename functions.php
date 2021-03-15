<?php
// connect database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// conect query
function query($query)
{
    global $conn;
    // lemari
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// tambahkan data
function data($daftar)
{
    global $conn;

    $name = htmlspecialchars($daftar["name"]);
    $location = htmlspecialchars($daftar["location"]);
    $rank = htmlspecialchars($daftar["rank"]);
    $total = htmlspecialchars($daftar["total"]);

    // uplod gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }


    $query = " INSERT INTO kampusku
    VALUES 
    ('','$name','$location','$rank','$total',
    '$gambar')
    ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    // pesan error
    if ($error === 4) {
        echo "<script>
                    alert('pilih gambar terlebih dahulu!')
                </script>";
        return false;
    }

    // cek apakah ada gambar yang di uplod?

    global $gambar;
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'svg', 'jfif'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    alert('yang di uplod bukan gambar!')
                </script>";
        return false;
    }

    // cek jika ukuranya terlalu besar
    if ($ukuranFile > 1000000) {
        echo   "<script>
                    alert('Kegedean BOSKU!')
                </script>";
        return false;
    }


    // gambar siap di uplod
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'gambar/' . $namaFileBaru);

    return $namaFileBaru;
}





// delete 
function delete($id)
{
    global $conn;
    mysqli_query($conn, " DELETE FROM kampusku WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// ubah
function ubah($daftar)
{
    global $conn;

    $id = $daftar["id"];
    $name = htmlspecialchars($daftar["name"]);
    $location = htmlspecialchars($daftar["location"]);
    $rank = htmlspecialchars($daftar["rank"]);
    $total = htmlspecialchars($daftar["total"]);
    $gambarLama = htmlspecialchars($daftar["gambarLama"]);

    // cek apakah user pilih gambar baru tidak

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE kampusku SET
        name = '$name',
        location = '$location',
        rank = '$rank',
        total = '$total',
        gambar = '$gambar'
        WHERE id = $id
    ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function search($keyword)
{
    $query = "SELECT * FROM kampusku 
            WHERE 
        name LIKE '%$keyword%' OR
        location LIKE '%$keyword%' OR
        rank LIKE '%$keyword%' OR
        total LIKE '%$keyword%'
        ";
    return query($query);
}

// function registrasi($data)
// {
//     // connect ke database
//     global $conn;

//     $username = strtolower(stripslashes($data["username"]));
//     $password = mysqli_real_escape_string($conn, $data["password"]);
//     $password2 = mysqli_real_escape_string($conn, $data["password2"]);


//     $result = mysqli_query($conn, "SELECT username FROM users 
//     WHERE username = '$username'");

//     if (mysqli_fetch_assoc($result)) {
//         echo "<script>
//         alert('username sudah terdaftar!')
//         </script>";

//         return false;
//     }
//     // confirmasi password
//     if ($password !== $password2) {
//         echo "<script>
//         alert('Password Tidak Sesuai')
//         </script>";

//         return false;
//     }



//     // enksripsi password
//     $password = password_hash($password, PASSWORD_DEFAULT);

//     // insert database
//     mysqli_query($conn, "INSERT INTO users VALUES('','$username','$password')");

//     return mysqli_affected_rows($conn);
// }

function daftar($isi)
{
    global $conn;

    $username = strtolower(stripslashes($isi["username"]));
    $password = mysqli_real_escape_string($conn, $isi["Password"]);
    $password2 = mysqli_real_escape_string($conn, $isi["Password2"]);


    // Cek Username
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Username sudah terdaftar!')
        </script>";
        return false;
    }
    // confirmasi password

    if ($password !== $password2) {
        echo "<script>
        alert('Password Tidak Sesuai')
        </script>";

        return false;
    }

    // enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // insert to database
    mysqli_query($conn, "INSERT INTO users VALUES('','$username','$password')");

    return mysqli_affected_rows($conn);
}
