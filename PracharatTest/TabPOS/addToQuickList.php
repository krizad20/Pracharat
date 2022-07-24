<?php
include('.././system/server.php');
$pID = $_POST["pID"];

$sql = "SELECT COALESCE(MAX(`id`)+1,1) AS id FROM quicklist WHERE id>0 ORDER BY `id` DESC LIMIT 1";
$getLast = mysqli_query($conn, $sql);
$last = mysqli_fetch_array($getLast, MYSQLI_ASSOC);
$genID = $last['id'];

$sql = "INSERT INTO `quicklist`(`id`,`pID`, `pName`) VALUES ($genID,'$pID', (SELECT pName FROM product WHERE pID = '$pID') )";
mysqli_query($conn, $sql);
