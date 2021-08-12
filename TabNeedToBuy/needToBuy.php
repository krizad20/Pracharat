<?php
include("..\system\server.php");
$sql = "SELECT * FROM `product` WHERE pDel = 0 AND pVal <= 2 ORDER BY `pID` ASC";
$res = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $arr[] = $row;
}
$dataset = array(
    "data" => $arr
);

echo json_encode($dataset);