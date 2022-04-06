<?php
include("system/server.php");
//delete sub barcode
$barcode = $_POST['barcode'];
$pID = $_POST['pID'];

$sql = "SELECT pBars FROM product WHERE pID = '$pID'";
$list = $conn->query($sql);

$output = "";
while ($row = $list->fetch_assoc()) {
    $output = $row['pBars'];
}
//parse to json
$json_arr = json_decode($output, true);
//edit
$newArr = [];
foreach ($json_arr as $key => $value) {
    if ($json_arr[$key]['barcode'] != $barcode) {
        $newArr[] = $json_arr[$key];
    }
}

$json = json_encode($newArr,JSON_UNESCAPED_UNICODE);
$sql = "UPDATE product SET pBars = '$json' WHERE pID = '$pID'";
$result = mysqli_query($conn, $sql);
