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
