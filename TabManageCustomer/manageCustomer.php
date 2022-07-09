<?php
include('.././system/server.php');
$mode = $_POST['mode'];


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
    $query = "SELECT * FROM `customer` WHERE `cName` = '$cName' AND `cSer` = '$cSer' AND `cHouse` = '$cHouse' AND `cMoo` = '$cMoo'";
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
else if ($mode == "edit") {
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
        echo "duplicate";
        exit();
    }

    $sql = "INSERT INTO customer(cID, cName,cSer, cHouse, cMoo, cIsMem, IsDel) 
            VALUES ('$cID','$cName','$cSer','$cHouse','$cMoo','$cIsMem','$IsDel')
            ON DUPLICATE KEY 
            UPDATE cID='$cID', cName='$cName',cSer = '$cSer',cHouse='$cHouse',cMoo='$cMoo',cIsMem='$cIsMem',IsDel = '$IsDel' ";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "success";
    } else {
        echo "fail";
    }
}
//DELETE
else if ($mode == "del") {
    $cID = $_POST["cID"];

    $sql = "UPDATE customer SET IsDel = 1 WHERE cID='$cID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "success";
    } else {
        echo "fail";
    }
}
//Get ID
else if ($mode == "getNewID") {
    $genID = "";

    $sql = "SELECT `cID` FROM `customer` WHERE `IsDel` = 1 LIMIT 1";
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
