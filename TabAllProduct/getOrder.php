<?php

session_start();
include('..\system\server.php');

$query = "SELECT * FROM `order` WHERE 1 LIMIT 1";

$list = $conn->query($query);
$output = [];
while ($row = $list->fetch_assoc()) {
    $output[] = $row["pIdList"];
}
$dataset = array(
    "name" => 'ทดสอบ',
    "data" => $output
);
$encode = json_encode($dataset);

echo $encode;
