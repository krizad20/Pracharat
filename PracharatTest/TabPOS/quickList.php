<?php
include(".././system/server.php");
$sql = "SELECT `id`, `pID`, `pName` FROM `quicklist` WHERE 1 ORDER BY `id`";
$res = mysqli_query($conn,$sql);
$arr = [];
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $arr[] = $row;
}
$dataset = array(
    "data" => $arr
);

echo json_encode($dataset,JSON_UNESCAPED_UNICODE);