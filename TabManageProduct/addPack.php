<?php
include('..\system\server.php');
$pID = $_POST["pID"];
$genID = "";

$sql = "SELECT `pID` FROM `packproduct` WHERE `pID` = '$pID' LIMIT 1";
$getLast = mysqli_query($conn, $sql);
$last = mysqli_fetch_array($getLast, MYSQLI_ASSOC);
$genID = $last['pID'];
++$genID;

?>
<?= $genID ?>


