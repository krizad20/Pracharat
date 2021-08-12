<?php
include('..\system\server.php');
$sID = $_POST["sID"];
$pID = $_POST["pID"];

$sqlDel = "DELETE FROM sale WHERE `pID` = '$pID' AND sID = '$sID'";
$msg = "del";
mysqli_query($conn, $sqlDel);



?>
<?= $msg ?>


