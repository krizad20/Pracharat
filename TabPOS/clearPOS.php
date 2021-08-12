<?php
include('..\system\server.php');
$sID = $_POST["sID"];

$sqlDel = "DELETE FROM sale WHERE sID = '$sID'";
mysqli_query($conn, $sqlDel);



?>
<?= $msg ?>


