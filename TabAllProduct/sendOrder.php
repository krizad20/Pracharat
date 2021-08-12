<?php

session_start();
include('..\system\server.php');

$arr = [];
foreach ($_SESSION["shopping_cart"] as $keys => $values) {
    $item_array = array(
        'pID'               =>     $values["product_id"],
        'pVal'         =>     $values["product_quantity"]
    );
    $arr[] = $item_array;
}
$encode = json_encode($arr, JSON_UNESCAPED_UNICODE);
$sql = "INSERT INTO `order`(`Name`, `pIdList`, `isSell`) VALUES ('ทดสอบ','$encode',0)";
mysqli_query($conn, $sql);
