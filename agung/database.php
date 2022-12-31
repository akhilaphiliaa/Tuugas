<?php
function connect_database(){
  $DB_HOST = "localhost";
  $DB_USER = "root";
  $DB_PASSWORD = "";
  $DB_DATABASE = "agung";

  $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE);
  if($mysqli->connect_error) die('Connect Error DB');
  return $mysqli;
}

function login($email, $password){
  $mysqli = connect_database();

  try {
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
  } catch (\Throwable $th) {
    throw $th;
  }

  return $result;
}

function registation($username, $email, $password, $jabatan, $referal_code){
  $mysqli = connect_database();

  if (referal_check($referal_code)) {
    $referal_code = substr(str_shuffle('0123456789'), 0, 5);

    $stmt = $mysqli->prepare("INSERT INTO users (username, jabtan, email, password , referal_code) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssi", $username, $jabatan, $email, $password, $referal_code);
    $stmt->execute();
    $user_id = $stmt->insert_id;
    $stmt->close();

    $stmt2 = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();
    $result = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt2->close();

    return $result;
  } else {
    return null;
  }
}

function referal_check($code){
  $mysqli = connect_database();

  $stmt = $mysqli->prepare("SELECT * FROM users WHERE referal_code = ? ");
  $stmt->bind_param("s", $code);
  $stmt->execute();
  $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  $stmt->close();

  if (count($result) != 0) {
    return true;
  } else {
    return false;
  }

}

?>