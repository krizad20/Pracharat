<?php
include(".././system/server.php");
$dateFrom = $_POST["dateFrom"];
$dateTo = $_POST["dateTo"];
$sql = "SELECT c.cID,c.cHouse,c.cName,(SELECT COALESCE(SUM(bTotal),0) FROM bill WHERE cID = c.cID AND DATE(bDate) >= '$dateFrom' AND DATE(bDate) <= '$dateTo') AS total
        FROM customer c";
$res = mysqli_query($conn,$sql);
$arr = [];
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $arr[] = $row;
}
$dataset = array(
    "data" => $arr
);

echo json_encode($dataset);