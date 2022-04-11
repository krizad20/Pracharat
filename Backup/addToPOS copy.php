<?php
include('../system/server.php');
$pID = $_POST["pIDAdd"];
$sID = $_POST["sIDNow"];

// -2 = Not Enough
// -1 = Invalid
// 0 = New
// 1 = Exist
// 2 = NeedToBuy
$eventCode = "-1";
//Check Invalid ID or Bar
$sql = "SELECT * FROM `product` WHERE pDel = 0 AND ((pID = '$pID' ) OR (pBar = '$pID'))";
$res = mysqli_query($conn, $sql);
$rowcount = mysqli_affected_rows($conn);
if ($rowcount <= 0) {
    $eventCode = "-1";
} else {
    //Check Is First In Bill
    $sql = "SELECT * FROM `sale` WHERE (pID = '$pID' OR pID = (SELECT pID FROM product WHERE pBar = '$pID')) AND sID = '$sID'";
    $res = mysqli_query($conn, $sql);
    $rowcount = mysqli_affected_rows($conn);
    //New
    $sql = "SELECT p.pVal - COALESCE(SUM(s.sVal),0) - pa.paPerPack AS val
            FROM product p, sale s, packproduct pa
            WHERE p.pID = pa.pID AND s.pID = pa.pID AND pa.paID = 'P00056'";

    if ($rowcount == 0) {
        $sql = "SELECT * FROM `product` WHERE ((pID = '$pID' ) OR (pBar = '$pID')) AND pVal > 0 AND pVal > (SELECT COALESCE(SUM(sVal),0) FROM sale WHERE (pID = '$pID' OR pID = (SELECT pID FROM product WHERE pBar = '$pID')))";
        $res = mysqli_query($conn, $sql);
        $rowcount = mysqli_affected_rows($conn);
        //Not Enough
        if ($rowcount <= 0) {
            $eventCode = "-2";
        }
        //Enough
        else {
            $sql = "INSERT INTO sale (sID,pID,sVal) VALUES  ('$sID',(SELECT pID FROM product WHERE pDel = 0 AND ((pID = '$pID' ) OR (pBar = '$pID'))),1)";
            $eventCode = "0";
            mysqli_query($conn, $sql);

            $sql = "SELECT p.pVal - SUM(s.sVal) AS pVal
                    FROM product p, sale s 
                    WHERE pDel = 0 AND ((p.pID = '$pID' ) OR (p.pBar = '$pID')) AND (s.pID = '$pID')";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $eventCode = $row["pVal"];
                if($row["pVal"] <= 2){
                    $eventCode = "2";
                }
            }
        }
    }
    //Exist
    else {
        $sql = "SELECT * FROM `product` WHERE ((pID = '$pID' ) OR (pBar = '$pID')) AND pVal > (SELECT COALESCE(SUM(sVal),0) FROM sale WHERE (pID = '$pID' OR pID = (SELECT pID FROM product WHERE pBar = '$pID')))";
        $res = mysqli_query($conn, $sql);
        $rowcount = mysqli_affected_rows($conn);
        //Not Enough
        if ($rowcount <= 0) {
            $eventCode = "-2";
        } else {
            $sql = "UPDATE `sale` SET sVal = sVal+1 WHERE (pID = '$pID' OR pID = (SELECT pID FROM product WHERE pBar = '$pID'))  AND sID = '$sID'";
            $eventCode = "1";
            mysqli_query($conn, $sql);

            $sql = "SELECT p.pVal - SUM(s.sVal) AS pVal
                    FROM product p, sale s 
                    WHERE pDel = 0 AND ((p.pID = '$pID' ) OR (p.pBar = '$pID')) AND (s.pID = '$pID')";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $eventCode = $row["pVal"];
                if($row["pVal"] <= 2){
                    $eventCode = "2";
                }
            }
        }
    }
}

?>

<?= $eventCode ?>


