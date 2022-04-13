<?php
session_start();
include("./system/server.php");



if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM `seller` WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $permission = $row['permission'];
    }
    $_SESSION['seller'] =  $username;
    $_SESSION['permission'] =  $permission;
    header("Location:index.php");
  } else {
    echo "<script>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');</script>";
    header("location:index.php");
  }
} else if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $permission = $_POST['permission'];
  if ($confirmPassword == "25092514") {
    $sql = "INSERT INTO seller (username, password, permission) VALUES ('$username', '$password', '$permission')";
    $result = $conn->query($sql);
    if ($result) {
      echo "<script>alert('สมัครสมาชิกสำเร็จ');</script>";
      $_SESSION['seller'] =  $username;
      $_SESSION['permission'] =  $permission;
      header("Location:index.php");
    } else {
      echo "<script>alert('สมัครสมาชิกไม่สำเร็จ');</script>";
      header("Location:index.php");
    }
  } else {
    echo "<script>alert('รหัสผ่านไม่ตรงกัน');</script>";
    header("Location:index.php");
  }
} else if (isset($_POST['logout'])) {
  session_destroy();
  header("Location:index.php");
}
