<?php
include('system/server.php');

$pID = $_POST["pID"];
$barcode = $_POST["barcode"];
$detail = $_POST["detail"];

//check duplicate barcode in product
$query = "SELECT pBars FROM `product` WHERE pDel != 1";
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
    $query1 = "SELECT pBars FROM `product` WHERE pID = '$pID' and pDel != 1";

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

?>
<?= $msg ?>
