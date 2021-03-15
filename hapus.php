<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET["id"];

if (delete($id) > 0) {
    echo "
    <script>
    alert('Data Berhasil dihapus!');
    document.location.href='index.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('Data tidak dihapus!');
    document.location.href='index.php';
    </script>
    ";
}
