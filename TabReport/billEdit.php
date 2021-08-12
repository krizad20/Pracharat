<?php
include('..\system\server.php');
//session_start();
$_SESSION['bIDEdit'] = $_POST["bID"];
$_SESSION['fromEdit'] = 1;
$bID = $_POST["bID"];

$sql = "DELETE FROM `sale` WHERE `sID` = 's5'";
$res = mysqli_query($conn, $sql);

//Check Invalid ID or Bar
$sql = "INSERT INTO `sale`(`pID`, `scID`, `sVal`)
        SELECT `bpID`, `cID`, `bpVal` 
        FROM `billdetail` 
        WHERE `bID` = '$bID'";
mysqli_query($conn, $sql);


