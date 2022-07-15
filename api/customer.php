<?php
include(".././system/server.php");
$mode = $_POST["mode"];

if ($mode == "findAllCustomer") {
    $sql = "SELECT * FROM `customer` WHERE IsDel = 0 ORDER BY `cID` ASC";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $arr[] = $row;
    }

    if ($result) {
        $respond = array(
            "status" => 200,
            "message" => "ค้นหาลูกค้าสำเร็จ",
            "data" => $arr
        );

        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $respond = array(
            "status" => 400,
            "message" => "ค้นหาลูกค้าไม่สำเร็จ",
            "data" => []
        );

        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
if ($mode == "findCustomerBycID") {
    $cID = $_POST['cID'];
    $sql = "SELECT * FROM customer WHERE cID = '$cID' and IsDel = 0 LIMIT 1";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $arr[] = $row;
    }

    if ($result) {
        $respond = array(
            "status" => 200,
            "message" => "ค้นหาลูกค้าสำเร็จ",
            "data" => $arr
        );

        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $respond = array(
            "status" => 400,
            "message" => "ค้นหาลูกค้าไม่สำเร็จ",
            "data" => []
        );

        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}


//ADD
if ($mode == "add") {
    $cID = $_POST["cID"];
    $cName = $_POST["cName"];
    $cSer = $_POST["cSer"];
    $cHouse = $_POST["cHouse"];
    $cMoo = $_POST["cMoo"];
    $cIsMem = $_POST["cIsMem"];
    $IsDel = 0;

    //check duplicate 
    $query = "SELECT * FROM `customer` WHERE `cName` = '$cName' AND `cSer` = '$cSer' AND `cHouse` = '$cHouse' AND `cMoo` = '$cMoo' and IsDel!=1";
    $list = $conn->query($query);

    if ($list->num_rows > 0) {
        //$isDuplicate = true;
        echo "duplicate";
        exit();
    }


    $sql = "INSERT INTO customer(cID, cName,cSer, cHouse, cMoo, cIsMem, IsDel) 
            VALUES ('$cID','$cName','$cSer','$cHouse',$cMoo,$cIsMem,$IsDel)
            ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "success";
    } else {
        echo "fail";
        echo $sql;
        echo $result;
    }
}
//EDIT
if ($mode == "save") {
    $cID = $_POST["cID"];
    $cName = $_POST["cName"];
    $cSer = $_POST["cSer"];
    $cHouse = $_POST["cHouse"];
    $cMoo = $_POST["cMoo"];
    $cIsMem = $_POST["cIsMem"];
    $IsDel = 0;


    //check duplicate 
    $sql = "SELECT cID FROM `customer` WHERE `cID` != `$cID` AND `cName` = '$cName' AND `cSer` = '$cSer' AND `cHouse` = '$cHouse' AND `cMoo` = '$cMoo'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        //$isDuplicate = true;
        $respond = array(
            "status" => 400,
            "message" => "รายชื่อลูกค้าซ้ำ",
            "data" => []
        );

        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }

    $sql = "INSERT INTO customer(cID, cName,cSer, cHouse, cMoo, cIsMem, IsDel) 
            VALUES ('$cID','$cName','$cSer','$cHouse','$cMoo','$cIsMem','$IsDel')
            ON DUPLICATE KEY 
            UPDATE cID='$cID', cName='$cName',cSer = '$cSer',cHouse='$cHouse',cMoo='$cMoo',cIsMem='$cIsMem',IsDel = '$IsDel' ";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $sql = "SELECT * FROM `customer` WHERE IsDel = 0 ORDER BY `cID` ASC";
        $res = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $arr[] = $row;
        }
        $respond = array(
            "status" => 200,
            "message" => "บันทึกรายชื่อลูกค้าสำเร็จ",
            "data" => $arr
        );

        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $respond = array(
            "status" => 400,
            "message" => "บันทึกรายชื่อลูกค้าไม่สำเร็จ",
            "data" => []
        );

        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
//DELETE
if ($mode == "del") {
    $cID = $_POST["cID"];

    $sql = "UPDATE customer SET IsDel = 1 WHERE cID='$cID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $sql = "SELECT * FROM `customer` WHERE IsDel = 0 ORDER BY `cID` ASC";
        $res = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $arr[] = $row;
        }
        $respond = array(
            "status" => 200,
            "message" => "ลบรายชื่อลูกค้าสำเร็จ",
            "data" => $arr
        );

        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $respond = array(
            "status" => 400,
            "message" => "ลบรายชื่อลูกค้าไม่สำเร็จ",
            "data" => []
        );

        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
//Get ID
if ($mode == "getNewID") {
    $genID = "";

    $sql = "SELECT `cID` FROM `customer` WHERE `IsDel` = 1 ORDER BY `cID` ASC LIMIT 1";
    $getDel = mysqli_query($conn, $sql);
    $del = mysqli_fetch_array($getDel, MYSQLI_ASSOC);

    if (!$del) {
        $sql = "SELECT `cID` FROM `customer` ORDER BY `cID` DESC LIMIT 1";
        $getLast = mysqli_query($conn, $sql);
        $last = mysqli_fetch_array($getLast, MYSQLI_ASSOC);

        $genID = $last['cID'];
        ++$genID;
    } else {
        $genID = $del['cID'];
    }
    echo $genID;
}
