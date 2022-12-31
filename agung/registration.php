<?php
require('database.php');
$base_url = "http://localhost/agung";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $result = registration($_POST["username"], $_POST['jabatan'], $_POST["email"], $_POST["password"], $_POST["referal_code"]);
  if ($result) {
    session_start();
    $_SESSION["data_login"] = $result;
    header("Location: /agung");
    die();
  } else {
    $message = "tidak bisa mendaftar";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Form</title>
  <style>
    body {
      text-align: center;
    }
    form {
      display: inline-block;
    }
  </style>
</head>
<body>
<form action="" method="POST">
  <?php !empty($message) ? print $message : ""?>
  <label> <h1>Registrasi Akun</h1> </label>
  <label>Nama :</label>
  <input type="text" name="username">
  <br><br>

  <label>Jabatan :</label>
  <input type="text" name="jabatan">
  <br><br>

  <label>Email :</label>
  <input type="email" name="email">
  <br><br>

  <label>Password :</label>
  <input type="password" name="password">
  <br><br>

  <label>Kode referal :</label>
  <input type="text" name="referal_code">
  <br><br>
  <button type="submit">Daftar</button>
  <br><br>

  <label>
    <a href="<?= $base_url . '/login.php'?>">Login ke akun</a>
  </label>
</form>
</body>
</html>