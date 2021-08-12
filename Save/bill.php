<?php
include("system\server.php");
$sql = "SELECT * FROM `bill` ORDER BY `bID` ASC";
$res = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $arr[] = $row;
}
$dataset = array(
    "data" => $arr
);

echo json_encode($dataset);