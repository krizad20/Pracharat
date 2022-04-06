<?php
include("system/server.php");
$pID = $_POST['pID'];
// $pID = "P00001";
//fetches the barcode from the database
$sql = "SELECT * FROM product WHERE pID = '$pID'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    $output = $row['pBars'];
}
$json_arr = json_decode($output, true);
// echo json_encode($json_arr,JSON_UNESCAPED_UNICODE);
$dataset = array(
    "data" => $json_arr
);

echo json_encode($dataset,JSON_UNESCAPED_UNICODE);
