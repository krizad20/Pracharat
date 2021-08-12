<?php
include('..\system\server.php');
//session_start();
//$bID = $_POST["bID"];
$sql = "SET GLOBAL time_zone = '+7:00'";
mysqli_query($conn, $sql);
$genID = "";
$sql = "SELECT * FROM `bill`";
$res = mysqli_query($conn, $sql);
$rowcount = mysqli_affected_rows($conn);


//No Data
if ($rowcount <= 0) {
    $genID = "B00001";
} 
//Have Data
else{
    $sql = "SELECT `bID` FROM `bill` ORDER BY `bID` DESC LIMIT 1";
    $getLast = mysqli_query($conn, $sql);
    $last = mysqli_fetch_array($getLast, MYSQLI_ASSOC);
    $genID = $last['bID'];
    ++$genID;
}
$sID = $_POST["sID"];
$cID = $_POST["cID"];
$bMoney = $_POST["bMoney"];
$bPra = $_POST["bPra"];
$bHalf = $_POST["bHalf"];
$bTotal = $_POST["bTotal"];
$bDis = $_POST["bDis"];
$note = $_POST["note"];


$sql = "INSERT INTO `bill`(`bID`, `cID`, `bMoney`, `bPra`, `bHalf`, `bDis`, `bTotal`, `bNote`) 
        VALUES ('$genID','$cID','$bMoney','$bPra','$bHalf','$bDis','$bTotal','$note')";
//$sql = "INSERT INTO `bill`(bID,cID,bTotal,bNote) VALUES ('$genID','$cID',$total,'$note')";
mysqli_query($conn, $sql);

$sqlDel = "DELETE FROM sale WHERE sID = '$sID'";
mysqli_query($conn, $sqlDel);
?>

<?=$genID?>


