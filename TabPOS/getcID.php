<?php
include("..\system\server.php");
//session_start();

$sID = $_POST["sID"];

$sql = "SELECT scID
        FROM sale 
        WHERE sID = '$sID' LIMIT 1";

if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    echo $row["scID"];
} else {
    echo "C0001";
}
