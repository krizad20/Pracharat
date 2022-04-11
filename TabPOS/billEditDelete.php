<?php
include('.././system/server.php');
//session_start();

$bID = $_SESSION['bIDEdit'];
$sID = $_POST["sID"];
$cID = $_POST["cID"];
$total = $_POST["total"];
$note = $_POST["note"];

$sql = "SELECT `bDate` FROM `bill` WHERE `bID` = '$bID' LIMIT 1";
$res = mysqli_query($conn, $sql);

while($row = mysqli_fetch_object($res)){
        $date = $row->bDate;
    }

$sql = "DELETE FROM `bill` WHERE `bID` = '$bID'";
mysqli_query($conn, $sql);

$sql = "UPDATE product p
        INNER JOIN billdetail b ON p.pID = b.bpID
        SET p.pVal = p.pVal+b.bpVal
        WHERE b.bID = '$bID'";
mysqli_query($conn, $sql);

$sql = "DELETE FROM `billdetail` WHERE `bID` = '$bID'";
mysqli_query($conn, $sql);

$sql = "INSERT INTO `bill`(bID,cID,bDate,bTotal,bNote) VALUES ('$bID','$cID','$date',$total,'$note')";
mysqli_query($conn, $sql);

$sqlDel = "DELETE FROM sale WHERE sID = '$sID'";
mysqli_query($conn, $sqlDel);

unset($_SESSION['bIDEdit']);
?>
<?=$bID?>


