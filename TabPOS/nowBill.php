<?php
include(".././system/server.php");
//session_start();
if (isset($_POST["sID"])) {
    $_SESSION['sIDAjax'] = $_POST["sID"];
}
$sID = '';
if (isset($_SESSION['sIDAjax'])) {
    $sID = $_SESSION['sIDAjax'];
}

$arr = [];
$sql = "SELECT s.pID AS pID ,p.pBar AS pBar,p.pSP AS pSP,p.pName AS pName, s.sVal AS pVal, s.sVal*p.pSP AS pTotal
        FROM sale s, product p 
        WHERE s.pID = p.pID AND s.sID = '$sID'
        GROUP BY pID";
$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    $arr[] = $row;
}
$dataset = array(
    "sID" => $sID,
    "totaldisplayrecords" => count($arr),
    "data" => $arr
);

echo json_encode($dataset);
