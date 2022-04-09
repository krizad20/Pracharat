<?php
include("..\system\server.php");
//วันที่ขาย เลขที่บิล รหัสสินค้า ชื่อสินค้า จำนวน ราคาขาย ต้นทุน กำไร
$dateFrom = $_POST["dateFrom"];
$dateTo = $_POST["dateTo"];
// $dateFrom = "2022-01-01";
// $dateTo = "2022-12-31";
$sql = "SELECT b.bDate,b.bID,b.bDetail
        FROM bill b
        WHERE DATE(b.bDate) >= '$dateFrom' AND DATE(b.bDate) <= '$dateTo'";

$res = mysqli_query($conn,$sql);
$arr = [];
$newArray = [];
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $arr[] = $row;
}

$sumSP = number_format((float)0, 2, '.', '');
$sumBP = number_format((float)0, 2, '.', '');


//foreach arr
for ($i=0; $i < sizeof($arr) ; $i++) {
    $output= $arr[$i]['bDetail'];
    $detailArr = json_decode($output, true);
    $bDate = $arr[$i]["bDate"];
    $bID = $arr[$i]["bID"];
    foreach ($detailArr as $key => $value) {
        $pID = $value["pID"];
        $pName = $value["pName"];
        $pQuantity = $value["pQuantity"];
        $pSP = $value["pSP"];
        $pBP = $value["pBP"];

        $sumSP += number_format((float)$pSP, 2, '.', '');
        $sumBP += number_format((float)$pBP, 2, '.', '');

        $pProfit = $pSP - $pBP;
        $newArray[] = array(
            "bDate" => $bDate,
            "bID" => $bID,
            "pID" => $pID,
            "pName" => $pName,
            "pQuantity" => $pQuantity,
            "pSP" => $pSP,
            "pBP" => $pBP,
            "pProfit" => number_format((float)$pProfit, 2, '.', '')
        );
        $bDate = "";
        $bID = "";        
    }
}

$newArray[] = array(
    "bDate" => "",
    "bID" => "",
    "pID" => "",
    "pName" => "",
    "pQuantity" => "",
    "pSP" => "",
    "pBP" => "ยอดขายรวม",
    "pProfit" => number_format((float)$sumSP, 2, '.', '')
);

$newArray[] = array(
    "bDate" => "",
    "bID" => "",
    "pID" => "",
    "pName" => "",
    "pQuantity" => "",
    "pSP" => "",
    "pBP" => "ต้นทุนรวม",
    "pProfit" => number_format((float)$sumBP, 2, '.', '')
);

$newArray[] = array(
    "bIDStatic" => "C",
    "bDate" => "",
    "bID" => "",
    "pID" => "",
    "pName" => "",
    "pQuantity" => "",
    "pSP" => "",
    "pBP" => "กำไรรวม",
    "pProfit" => number_format((float)$sumSP - $sumBP, 2, '.', '')
);

$dataset = array(
    "data" => $newArray
);

echo json_encode($dataset,JSON_UNESCAPED_UNICODE);