<?php
include(".././system/server.php");
$dateFrom = $_POST["dateFrom"];
$dateTo = $_POST["dateTo"];

$sql = "SELECT pID,pName,pDel as pCnt FROM `product` WHERE `pDel` = 0";
$result = mysqli_query($conn, $sql);
$product = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $product[$row['pID']] = $row;
    }
}

$sql = "SELECT bDetail FROM bill
        WHERE DATE(bDate) >= '$dateFrom' AND DATE(bDate) <= '$dateTo'";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    $bDetail = $row['bDetail'];
    $json_arr = json_decode($bDetail, true);
    foreach ($json_arr as $key => $value) {
        $product[$value['pID']]['pCnt'] += $value['pQuantity'];
    }
}


$arr;
foreach ($product as $key => $value) {
    $arr[] = $value;
}



$dataset = array(
    "data" => $arr
);

echo json_encode($dataset,JSON_UNESCAPED_UNICODE);
