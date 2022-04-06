<?php
include('system\server.php');
//session_start();
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

$_SESSION['genID'] = $genID;
?>
<?= $genID?>


