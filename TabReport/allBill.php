<?php
include("..\system\server.php");
$dateFrom = $_POST["dateFrom"];
$dateTo = $_POST["dateTo"];
$sql = "SELECT b.bDate,b.bID,c.cHouse,c.cName,bt.bpID,bt.bpName,bt.bpVal,(bt.bpSP * bt.bpVal) AS bpSP,(bt.bpBP * bt.bpVal) AS bpBP, (bt.bpSP * bt.bpVal - bt.bpBP * bt.bpVal) AS profit
        FROM bill b, customer c, billdetail bt
        WHERE bt.bID = b.bID AND bt.cID = c.cID AND DATE(b.bDate) >= '$dateFrom' AND DATE(b.bDate) <= '$dateTo'";
$res = mysqli_query($conn,$sql);
$arr = [];
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $arr[] = $row;
}
$dataset = array(
    "data" => $arr
);

echo json_encode($dataset);