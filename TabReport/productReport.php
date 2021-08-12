<?php
include("..\system\server.php");
$dateFrom = $_POST["dateFrom"];
$dateTo = $_POST["dateTo"];
$sql = "SELECT bt.bpID, bt.bpName, SUM(bt.bpVal) AS sCnt 
        FROM bill b , billdetail bt
        WHERE b.bID = bt.bID AND DATE(b.bDate) >= '$dateFrom' AND DATE(b.bDate) <= '$dateTo' 
        GROUP BY bt.bpID";
$res = mysqli_query($conn,$sql);
$arr = [];
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $arr[] = $row;
}
$dataset = array(
    "data" => $arr
);

echo json_encode($dataset);