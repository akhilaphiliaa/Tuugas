<?php
session_start();
require('database.php');

$base_url = "http://localhost/agung";

if (empty($_SESSION["data_login"])) {
  header("Location: " . $base_url . "/login.php");
  die();
}

// logout action
if (count($_SESSION) != 0 && $_SERVER["REQUEST_METHOD"] == "POST" && $_POST['logout'] == 'true') {
  session_destroy();
  header("Location: " . $base_url . "/login.php");
  die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Informasi Users</title>
  <style>
    body {
      text-align: center;
      background-color: blueviolet;
      color: white;
    }
    button {
      background-color: pink;
    }
    table {
      background-color: violet;
    }
  </style>
</head>
<body>
<center>
  <h1>Selamat Datang Di Dashboard </h1>
  <h2>Informasi Tentang Anda</h2>
  <table>
    <tr>
      <td>Nama Lengkap</td>
      <td>: <?= $_SESSION['data_login'][0]['username']?></td>
    </tr>
    <tr>
      <td>Jabatan</td>
      <td>: <?= $_SESSION['data_login'][0]['jabatan']?></td>
    </tr>

  <form action="" method="post">
    <input type="hidden" name="logout" value="true">
    <button type="submit" value="true" >Logout</button>
  </form>
</center>
</body>
</html>