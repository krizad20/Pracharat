<?php
include('..\system\server.php');
$mode = $_POST['mode'];


//ADD
if ($mode == "add") {
    $pID = $_POST["pID"];
    $pBar = $_POST["pBar"];
    $pName = $_POST["pName"];
    $pBP = $_POST["pBP"];
    $pSP = $_POST["pSP"];
    $pVal = $_POST["pVal"];
    $pCate = $_POST["pCate"];
    $pUnit = $_POST["pUnit"];
    if (isset($_POST["isPacked"])) {
        $isPacked = $_POST["isPacked"];
    } else {
        $isPacked = 0;
    }
    //check duplicate barcode in product
    $query = "SELECT pBars FROM `product` WHERE `pID` != '$pID' AND `pBars` LIKE '%" . '"' . $pBar . '"' . "%'";
    $list = $conn->query($query);

    if ($list->num_rows > 0) {
        //$isDuplicate = true;
        echo "duplicate";
        exit();
    }
    //If gen ID is from del -> UPDATE
    $pBars = '[{"detail":"รหัสสินค้า","barcode":"' . $pID . '"},{"detail":"บาร์โค้ดหลัก","barcode":"' . $pBar . '"}]';
    $sql = "INSERT INTO product(pID, pBar,pBars, pName, pBP, pSP, pVal, pCate, pUnit, isPacked) 
            VALUES ('$pID','$pBar','$pBars','$pName',$pBP,$pSP,$pVal,'$pCate','$pUnit',$isPacked)
            ON DUPLICATE KEY UPDATE pBar='$pBar',pBars = '$pBars',pName='$pName',pBP=$pBP,pSP=$pSP,pVal=$pVal,pCate='$pCate',pUnit='$pUnit',pDel = 0,isPacked=$isPacked";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "success";
    } 
    else {
        echo "fail";
        echo $sql;
        echo $result;

    }
}
//EDIT
else if ($mode == "edit") {
    $pID = $_POST["pID"];
    $pBar = $_POST["pBar"];
    $pName = $_POST["pName"];
    $pBP = $_POST["pBP"];
    $pSP = $_POST["pSP"];
    $pVal = $_POST["pVal"];
    $pCate = $_POST["pCate"];
    $pUnit = $_POST["pUnit"];
    if (isset($_POST["isPacked"])) {
        $isPacked = $_POST["isPacked"];
    } else {
        $isPacked = 0;
    }
    //check duplicate barcode in product
    $query = "SELECT pBars FROM `product` WHERE `pID` != '$pID' AND `pBars` LIKE '%" . '"' . $pBar . '"' . "%'";
    $list = $conn->query($query);

    if ($list->num_rows > 0) {
        //$isDuplicate = true;
        echo "duplicate";
        exit();
    } else {
        $query = "SELECT pBars FROM `product` WHERE `pID` = '$pID'";
        $list = $conn->query($query);
        $row = $list->fetch_assoc();
        $pBars = $row["pBars"];
        $pBars = json_decode($pBars, true);
        $pBars[1]["barcode"] = $pBar;
        $pBars = json_encode($pBars, JSON_UNESCAPED_UNICODE);
    }

    $sql = "UPDATE product SET pBar='$pBar',pBars = '$pBars',pName='$pName',pBP=$pBP,pSP=$pSP,pVal=$pVal,pCate='$pCate',pUnit='$pUnit',isPacked = $isPacked WHERE pID='$pID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "success";
    } else {
        echo "fail";
    }
}
//DELETE
else if ($mode == "del") {
    $pID = $_POST["pID"];
    $sql1 = "UPDATE product SET pDel = 1 WHERE pID = '$pID' AND pID = (SELECT paID FROM packproduct WHERE pID = '$pID')";
    $result1 = mysqli_query($conn, $sql1);
    $sql2 = "DELETE FROM packproduct WHERE pID = '$pID' OR paID = '$pID'";
    $result2 = mysqli_query($conn, $sql2);
    if ($result1 && $result2) {
        echo "success";
    } else {
        echo "fail";
    }
}
//Get ID
else if ($mode == "getNewID") {
    $genID = "";

    $sql = "SELECT `pID` FROM `product` WHERE `pDel` = 1 LIMIT 1";
    $getDel = mysqli_query($conn, $sql);
    $del = mysqli_fetch_array($getDel, MYSQLI_ASSOC);

    if (!$del) {
        $sql = "SELECT `pID` FROM `product` ORDER BY `pID` DESC LIMIT 1";
        $getLast = mysqli_query($conn, $sql);
        $last = mysqli_fetch_array($getLast, MYSQLI_ASSOC);

        $genID = $last['pID'];
        ++$genID;
    } else {
        $genID = $del['pID'];
    }
    echo $genID;
}
//Add Sub Barcode
else if ($mode == "addSubBarcode") {
    $pID = $_POST["pID"];
    $barcode = $_POST["barcode"];
    $detail = $_POST["detail"];

    //check duplicate barcode in product
    $query = "SELECT pBars FROM `product`";
    $list = $conn->query($query);
    $output = [];
    $isDuplicate = false;
    $msg = "";

    while ($row = $list->fetch_assoc()) {
        $output[] = $row['pBars'];
    }
    foreach ($output as $key => $value) {
        $json_arr = json_decode($value, true);
        foreach ($json_arr as $key => $value) {
            if ($value['barcode'] == $barcode) {
                $isDuplicate = true;
                $msg =  "duplicate";
                exit();
            }
        }
    }

    if ($isDuplicate == false) {
        $query1 = "SELECT pBars FROM `product` WHERE pID = '$pID'";

        $list1 = $conn->query($query1);
        $output1;
        while ($row = $list1->fetch_assoc()) {
            $output1 = $row['pBars'];
        }
        //parse to array
        $json_arr1 = json_decode($output1, true);
        //new arr
        $new_arr1[] = array('detail' => $detail, 'barcode' => $barcode);
        //add new
        $json_arr1[] = $new_arr1[0];


        $newJson1 = json_encode($json_arr1, JSON_UNESCAPED_UNICODE);

        $sql = "UPDATE `product` SET `pBars`='$newJson1' WHERE pID = '$pID'";
        mysqli_query($conn, $sql);
        $msg =  "success";
    }
}
//Del Sub Barcode
else if ($mode == "delSubBarcode") {
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

    $json = json_encode($newArr, JSON_UNESCAPED_UNICODE);
    $sql = "UPDATE product SET pBars = '$json' WHERE pID = '$pID'";
    $result = mysqli_query($conn, $sql);
}


//Add To Stock
if (isset($_POST['addToStock'])) {
    $pID = $_POST["pID"];
    $pName = $_POST["pName"];
    $pAdd = $_POST["pAddVal"];
    $sql = "INSERT INTO `addtostock`(`apID`, `apName`, `aVal`) VALUES ('$pID','$pName',$pAdd)";
    $query = mysqli_query($conn, $sql);
}
