<?php
include('..\system\server.php');
$ID = $_POST["ID"]; //2
$de = $ID-1; //1
$in = $ID+1; //3
$status = $_POST["status"];
$newID = "";

if($status == "up"){
    $sql = "UPDATE `quicklist` SET `id`='0' WHERE `id` = '$ID'";
    mysqli_query($conn, $sql);
    $sql = "UPDATE `quicklist` SET `id`='$ID' WHERE `id` = '$de'";
    mysqli_query($conn, $sql);
    $sql = "UPDATE `quicklist` SET `id`='$de' WHERE `id` = '0'";
    mysqli_query($conn, $sql);
    $newID = $de;
}
else{
    $sql = "UPDATE `quicklist` SET `id`='0' WHERE `id` = '$ID'";
    mysqli_query($conn, $sql);
    $sql = "UPDATE `quicklist` SET `id`='$ID' WHERE `id` = '$in'";
    mysqli_query($conn, $sql);
    $sql = "UPDATE `quicklist` SET `id`='$in' WHERE `id` = '0'";
    mysqli_query($conn, $sql);
    $newID = $in;
}
?>
<?= $newID ?>