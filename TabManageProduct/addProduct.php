<?php
include('..\system\server.php');
$genID = "";

$sql = "SELECT `pID` FROM `product` WHERE `pDel` = 1 LIMIT 1";
$getDel = mysqli_query($conn, $sql);
$del = mysqli_fetch_array($getDel, MYSQLI_ASSOC);

if (!$del) {
    $sql = "SELECT `pID` FROM `product` ORDER BY `pID` DESC LIMIT 1";
    $getLast = mysqli_query($conn, $sql);
    $last = mysqli_fetch_array($getLast, MYSQLI_ASSOC);

    $genID = $last['pID'];
    ++$genID;
} else {
    $genID = $del['pID'];
}

?>
<?= $genID ?>


