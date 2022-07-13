<?php
//session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pracharat";

//Connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
//Check

if (!$conn) {
    $servername = "localhost";
    $username = "u396242790_krizad";
    $password = "Moomint1812";
    $dbname = "u396242790_pracharat";

    //Connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, "utf8");
    if (!$conn) {
        $servername = "127.0.0.1:50776";
        $username = "azure";
        $password = "6#vWHD_$";
        $dbname = "pracharat";

        //Connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        mysqli_set_charset($conn, "utf8");
        if (!$conn) {
            die("Fail" . mysqli_connect_error());
        }
    }
}



if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle)
    {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}

function updateStock($conn, $pID, $newVal, $pBP, $pSP)
{
    $sql = "UPDATE product SET pVal = pVal + $newVal, pBP = $pBP, pSP = $pSP WHERE pID = '$pID'";
    return mysqli_query($conn, $sql);
}

function updateForPack($conn, $pID, $newVal, $pBP, $pSP)
{
    
    $sql = "UPDATE product p, packproduct pa 
            SET p.pVal = p.pVal + ((SELECT paPerPAck*$newVal FROM packproduct WHERE paID = '$pID'))
            WHERE p.hasPacked = 1 AND p.pID = (SELECT pID FROM packproduct WHERE paID = '$pID')";
    mysqli_query($conn, $sql);

    $sql = "UPDATE product p, packproduct pa 
            SET p.pVal = FLOOR((SELECT p.pVal/(pa.paPerPack*1.0) 
                                FROM product p, packproduct pa 
                                WHERE p.pID = '$pID'  AND pa.pID = p.pID)) 
            WHERE p.isPacked = 1 AND p.pID = (SELECT paID FROM packproduct WHERE pID = '$pID')";
    mysqli_query($conn, $sql);
}
