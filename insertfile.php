<?php

include("system\server.php");

$query = "SELECT * FROM product ORDER BY pID ASC";

$list = $conn->query($query);
$id = '';
$path = '';
while ($row = $list->fetch_assoc()) {
    $id = str_replace("P", "", $row["pID"]) + 0;

    $filePNG = 'product_pic\\' . $id . '.png';
    $fileJPG = 'product_pic\\' . $id . '.jpg';

    $filePNG_prd = 'product_pic\\prd_' . $id+16 . '.png';
    $fileJPG_prd = 'product_pic\\prd_' . $id+16 . '.jpg';

    //echo $file;
    if (file_exists($filePNG)) {
        $pID = $row["pID"];
        $path = $id . '.png';
        $sql = "UPDATE `product` SET `img`= '$path' WHERE `pID` = '$pID'";
        mysqli_query($conn, $sql);
    } else if (file_exists($fileJPG)) {
        $pID = $row["pID"];
        $path = $id . '.jpg';
        $sql = "UPDATE `product` SET `img`= '$path' WHERE `pID` = '$pID'";
        mysqli_query($conn, $sql);
        
    }
    else if (file_exists($filePNG_prd)) {
        $pID = $row["pID"];
        $path = 'prd_' . $id+16 . '.png';
        $sql = "UPDATE `product` SET `img`= '$path' WHERE `pID` = '$pID'";
        mysqli_query($conn, $sql);
    } else if (file_exists($fileJPG_prd)) {
        $pID = $row["pID"];
        $path = 'prd_' . $id+16 . '.jpg';
        $sql = "UPDATE `product` SET `img`= '$path' WHERE `pID` = '$pID'";
        mysqli_query($conn, $sql);
        
    }

    //file_exists();
}
echo "success";
