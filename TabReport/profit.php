<?php
include("..\system\server.php");
//วันที่ขาย เลขที่บิล รหัสสินค้า ชื่อสินค้า จำนวน ราคาขาย ต้นทุน กำไร
// $dateFrom = $_POST["dateFrom"];
// $dateTo = $_POST["dateTo"];
$dateFrom = "2022-01-01";
$dateTo = "2022-12-31";
$sql = "SELECT b.bDate,b.bID,b.bDetail
        FROM bill b
        WHERE DATE(b.bDate) >= '$dateFrom' AND DATE(b.bDate) <= '$dateTo'";

$res = mysqli_query($conn,$sql);
$arr = [];
$newArray = [];
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $arr[] = $row;
}

//foreach arr
for ($i=0; $i < sizeof($arr) ; $i++) {
    $output= $arr[$i]['bDetail'];
    $detailArr = json_decode($output, true);
    $bIDStatic = $arr[$i]['bID'];
    $bDate = $arr[$i]["bDate"];
    $bID = $arr[$i]["bID"];
    foreach ($detailArr as $key => $value) {
        $pID = $value["pID"];
        $pName = $value["pName"];
        $pQuantity = $value["pQuantity"];
        $pSP = $value["pSP"];
        $pBP = $value["pBP"];
        $pProfit = $pSP - $pBP;
        $newArray[] = array(
            "bIDStatic" => $bIDStatic,
            "bDate" => $bDate,
            "bID" => $bID,
            "pID" => $pID,
            "pName" => $pName,
            "pQuantity" => $pQuantity,
            "pSP" => $pSP,
            "pBP" => $pBP,
            "pProfit" => $pProfit
        );
        $bDate = "";
        $bID = "";        
    }
}

$dataset = array(
    "data" => $newArray
);

echo json_encode($dataset,JSON_UNESCAPED_UNICODE);