<?php
include("..\system\server.php");
$sql = "select * from customer where cID = '" . $_POST['cID'] . "'";
$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    $arr[] = $row;
}

echo json_encode($arr);
