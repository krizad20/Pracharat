<?php
include('..\system\server.php');
$pID = $_POST["pIDSave"];
$pBar = $_POST["pBarSave"];
$pName = $_POST["pNameSave"];
$pBP = $_POST["pBPSave"];
$pSP = $_POST["pSPSave"];
$pVal = $_POST["pValSave"];
$pCate = $_POST["pCateSave"];
$pUnit = $_POST["pUnitSave"];
$isAdd = $_POST['isAdd'];

$sql = "SELECT `pID` FROM `product` WHERE `pID` = '$pID'";
$query = mysqli_query($conn, $sql);
//$data = mysqli_fetch_array($query, MYSQLI_ASSOC);

//Add To Stock
if (isset($_POST['addToStock'])) {
    $pAdd = $_POST["pAddVal"];
    $sql = "INSERT INTO `addtostock`(`apID`, `apName`, `aVal`) VALUES ('$pID','$pName',$pAdd)";
    $query = mysqli_query($conn, $sql);
}

//NEW
if ($isAdd == "true" && ($query)) {
    $sql = "INSERT INTO product(pID, pBar, pName, pBP, pSP, pVal, pCate, pUnit) 
            VALUES ('$pID','$pBar','$pName',$pBP,$pSP,$pVal,'$pCate','$pUnit')";
    if (mysqli_query($conn, $sql)) {
        $msg = "เพิ่มสินค้าสำเร็จ";
    } else {
        $msg = "เพิ่มสินค้าไม่สำเร็จ";
    }
}
//UPDATE
else {
    $sql = "UPDATE product SET pBar='$pBar',pName='$pName',pBP=$pBP,pSP=$pSP,pVal=$pVal,pCate='$pCate',pUnit='$pUnit',pDel = 0 WHERE pID = '$pID'";
    if (mysqli_query($conn, $sql)) {
        $msg = "บันทึกสินค้าสำเร็จ";
    } else {
        $msg = "บันทึกสินค้าไม่สำเร็จ";
    }
}
?>
<?= $msg ?>


