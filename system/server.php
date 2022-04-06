<?php
//session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pracharat";
$login;
// if (isset($_POST['login'])) {
//     $_SESSION['login'] = $_POST['password'];
//     $login = $_POST['password'];
// }

// $servername = "127.0.0.1:50776";
// $username = "azure";
// $password = "6#vWHD_$";
// $dbname = "pracharat";

//Connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
//Check
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

if (!function_exists('str_contains')) {
	function str_contains($haystack, $needle)
	{
		return $needle !== '' && mb_strpos($haystack, $needle) !== false;
	}
}
