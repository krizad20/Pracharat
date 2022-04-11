<?php
include('.././system/server.php');
$ID = $_POST["ID"];


$sql = "DELETE FROM `quicklist` WHERE `id` = '$ID'";
mysqli_query($conn, $sql);

$sql = "SELECT COALESCE(MAX(`id`),1) AS id FROM quicklist WHERE id>0 ORDER BY `id` DESC LIMIT 1";
$getLast = mysqli_query($conn, $sql);
$last = mysqli_fetch_array($getLast, MYSQLI_ASSOC);
$MAX = $last['id'];

for ($i = $ID; $i < $MAX; $i++) {
    $sql = "UPDATE `quicklist` SET `id`= $i WHERE `id` = $i+1";
    mysqli_query($conn, $sql);
}
