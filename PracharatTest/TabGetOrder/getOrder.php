<?php

//session_start();
include('.././system/server.php');

$query = "SELECT * FROM `order` WHERE 1";

$list = $conn->query($query);
$output = [];
while ($row = $list->fetch_assoc()) {
    $output = $row['pIdList'];
}


$dataset = array(
    "data" => json_decode($output)
);
$encode = json_encode($dataset, JSON_UNESCAPED_UNICODE);

echo $encode;
