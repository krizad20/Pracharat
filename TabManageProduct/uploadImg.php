<?php
include('.././system/server.php');

$pID = $_POST['pID'];
$dir = ".././product_pic/";
move_uploaded_file($_FILES["image"]["tmp_name"], $dir . $pID . ".png");

$sql = "UPDATE product SET img = '$pID.png' WHERE pID = '$pID'";
$result = mysqli_query($conn, $sql);

?>