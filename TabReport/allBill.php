<?php
include(".././system/server.php");
$dateFrom = $_POST["dateFrom"];
$dateTo = $_POST["dateTo"];
$sql = "SELECT b.bDate,b.bID,c.cHouse,c.cName,b.bDetail,b.bTotal
        FROM bill b, customer c
        WHERE b.cID = c.cID AND DATE(b.bDate) >= '$dateFrom' AND DATE(b.bDate) <= '$dateTo'";

$res = mysqli_query($conn,$sql);
$arr = [];
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $arr[] = $row;
}
$dataset = array(
    "data" => $arr
);

echo json_encode($dataset);