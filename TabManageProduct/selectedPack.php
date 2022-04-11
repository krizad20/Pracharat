<?php
include(".././system/server.php");
$sql = "SELECT pa.paID, pa.pID, pa.pBar, pa.paName, pa.paPerPack, p.pBP, p.pVal FROM packproduct pa , product p WHERE pa.pID = p.pID AND pa.paID = '" . $_POST['pID'] . "'";
$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    $arr[] = $row;
}

echo json_encode($arr);
