<?php
include(".././system/server.php");

$sID = $_POST["sID"];
$cID = $_POST["cID"];

$sql = "UPDATE `sale` SET `scID`='$cID' WHERE sID = '$sID'";
mysqli_query($conn,$sql);

$sql = "SELECT cName FROM customer 
        WHERE cID = '$cID'";

$row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
echo $row["cName"];

