<?php
include('..\system\server.php');
$paID = $_POST["paIDSave"];
$pID = $_POST["pIDSave"];
$paName = $_POST["paNameSave"];
$paPerPack = $_POST["paPerPackSave"];

$sql = "INSERT INTO `packproduct`(`paID`, `pID`, `pBar`, `paName`, `paPerPack`) 
        VALUES ('$paID','$pID',(SELECT `pBar` FROM product WHERE `pID` = '$pID'),'$paName',$paPerPack)
        ON DUPLICATE KEY UPDATE `pID` = '$pID', `pBar` = (SELECT `pBar` FROM product WHERE `pID` = '$pID'), 
                                `paName` = '$paName', `paPerPack` = $paPerPack";
if (mysqli_query($conn, $sql)) {
    $msg = "เพิ่มแพ็คสำเร็จ";
} else {
    $msg = "เพิ่มสินค้าไม่สำเร็จ";
}

?>
<?= $msg ?>


