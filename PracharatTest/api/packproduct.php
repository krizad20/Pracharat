<?php
include(".././system/server.php");
$mode = $_POST["mode"];

if ($mode == 'savePack') {
    $paID = $_POST["paIDSave"];
    $pID = $_POST["pIDSave"];
    $paName = $_POST["paNameSave"];
    $paPerPack = $_POST["paPerPackSave"];

    $sql1 = "INSERT INTO `packproduct`(`paID`, `pID`, `pBar`, `paName`, `paPerPack`) 
        VALUES ('$paID','$pID',(SELECT `pBar` FROM product WHERE `pID` = '$pID'),'$paName',$paPerPack)
        ON DUPLICATE KEY UPDATE `pID` = '$pID', `pBar` = (SELECT `pBar` FROM product WHERE `pID` = '$pID'), 
                                `paName` = '$paName', `paPerPack` = $paPerPack";
    $result1 = mysqli_query($conn, $sql1);

    $sql2 = "UPDATE `product` SET `hasPacked` = 1 WHERE `pID` = '$pID'";
    $result2 = mysqli_query($conn, $sql2);
    if ($result1 && $result2) {
        $respond = array(
            "status" => 200,
            "message" => "บันทึกสินค้าแพ็คสำเร็จ",
            "data" => []
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $respond = array(
            "status" => 400,
            "message" => "บันทึกสินค้าแพ็คไม่สำเร็จ",
            "data" => []
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}

if ($mode == 'findPackProductBypID') {
    $pID = $_POST["pID"];
    $sql = "SELECT pa.paID, pa.pID, pa.pBar, pa.paName, pa.paPerPack, p.pBP, p.pVal FROM packproduct pa , product p WHERE pa.pID = p.pID AND pa.paID = '$pID'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $arr[] = $row;
    }
    if ($result) {
        $respond = array(
            "status" => 200,
            "message" => "ค้นหาสินค้าแพ็คสำเร็จ",
            "data" => $arr[0]
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $respond = array(
            "status" => 400,
            "message" => "ค้นหาสินค้าแพ็คสำเร็จ",
            "data" => []
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
