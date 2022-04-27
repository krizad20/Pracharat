<?php
    include(".././system/server.php");
    $sql = "SELECT `pUnit` FROM `product` GROUP BY `pUnit`";
    $res = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
        $arr[] = $row;
    }

    echo json_encode($arr,JSON_UNESCAPED_UNICODE);