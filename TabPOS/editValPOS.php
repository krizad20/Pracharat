<?php
include('..\system\server.php');
$sID = $_POST["sID"];
$pID = $_POST["pID"];
$newVal = $_POST["newVal"];

$sql = "SELECT * FROM `product` WHERE pID = '$pID' AND pVal >= $newVal AND pVal >= (SELECT COALESCE(SUM(sVal),0) FROM sale WHERE pID = '$pID' AND sID != '$sID') + $newVal";
$res = mysqli_query($conn, $sql);
$productCount = mysqli_affected_rows($conn);

$sql = "SELECT p.pVal - COALESCE(SUM(s.sVal),0) - (pa.paPerPack*(SELECT COALESCE(SUM(sVal),0) FROM `sale` WHERE pID = '$pID' AND sID != '$sID')) - (pa.paPerPack*$newVal) AS val
        FROM product p, sale s, packproduct pa
        WHERE p.pID = pa.pID AND s.pID = pa.pID AND pa.paID = '$pID' AND s.sID != '$sID'";
$res = mysqli_query($conn, $sql);
$packVal = mysqli_fetch_array($res, MYSQLI_ASSOC);

//Check Product
$sql = "SELECT isPacked FROM `product` WHERE ((pID = '$pID' ) OR (pBar = '$pID'))";
$res = mysqli_query($conn, $sql);
$isPacked = mysqli_fetch_array($res, MYSQLI_ASSOC);

//Normal Product
if ($isPacked['isPacked'] == 0) {
    //Not Enough
    if ($productCount <= 0) {
        $eventCode = "-2";
    }
    //Enough
    else {
        $sql = "UPDATE `sale` SET sVal = $newVal WHERE pID = '$pID' AND sID = '$sID'";
        $eventCode = "1";
        mysqli_query($conn, $sql);
    }
}
//Packed Product
else {
    if ($packVal['val'] <= 0) {
        $eventCode = "-2";
    } else {
        $sql = "UPDATE `sale` SET sVal = $newVal WHERE pID = '$pID' AND sID = '$sID'";
        $eventCode = "1";
        mysqli_query($conn, $sql);
        if ($packVal['val'] <= 2) {
            $eventCode = "2";
        }
    }
}







?>


<?= $eventCode ?>


