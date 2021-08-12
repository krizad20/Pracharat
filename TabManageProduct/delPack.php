<?php
include('..\system\server.php');
$pID = $_POST["pIDSave"];
$sql = "UPDATE product SET pDel = 1 WHERE pID = '$pID'";
$msg = "";
if(mysqli_query($conn, $sql)){
    $msg = "ลบสำเร็จ";
}
else{
    $msg = "ลบไม่สำเร็จ";
}
?>
<?= $msg?>


