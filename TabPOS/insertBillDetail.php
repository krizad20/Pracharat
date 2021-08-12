<?php
include('..\system\server.php');
$bID = $_POST["bID"];
$cID = $_POST["cID"];
$bpID = $_POST["bpID"];
$bpName = $_POST["bpName"];
$bpVal = $_POST["bpVal"];
$bpSP = $_POST["bpSP"];


$sql = "INSERT INTO `billdetail`(`bID`, `cID`, `bpID`, `bpName`, `bpVal`, `bpSP`, `bpBP`) 
        VALUES ('$bID','$cID','$bpID','$bpName','$bpVal','$bpSP',(SELECT pBP FROM product WHERE pID = '$bpID'))";
$res = mysqli_query($conn, $sql);

$sql = "SELECT `isPacked` FROM `product` WHERE `pID` = '$bpID'";
$getIsPack = mysqli_query($conn, $sql);
$isPack = mysqli_fetch_array($getIsPack, MYSQLI_ASSOC);
if ($isPack['isPacked'] == 1) {
        $sql = "UPDATE `product` SET `pVal`= pVal-(SELECT paPerPack*$bpVal FROM packproduct WHERE paID = '$bpID') WHERE pID = (SELECT pID FROM packproduct WHERE paID = '$bpID')";
        $res = mysqli_query($conn, $sql);
} else {
        $sql = "UPDATE `product` SET `pVal`= pVal-$bpVal WHERE pID = '$bpID'";
        $res = mysqli_query($conn, $sql);
}
