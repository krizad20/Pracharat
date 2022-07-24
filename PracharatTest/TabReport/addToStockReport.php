<?php
include(".././system/server.php");
$dateFrom = $_POST["dateFrom"];
$dateTo = $_POST["dateTo"];
$sql = "SELECT * FROM `addtostock` WHERE DATE(aDate) >= '$dateFrom' AND DATE(aDate) <= '$dateTo'";
$res = mysqli_query($conn,$sql);
$arr = [];
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $arr[] = $row;
}
$dataset = array(
    "data" => $arr
);

echo json_encode($dataset,JSON_UNESCAPED_UNICODE);