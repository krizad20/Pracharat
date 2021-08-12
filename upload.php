<?php
include("system\server.php");
// File upload path
$targetDir = "product_pic/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        $temp = explode(".", $_FILES["file"]["name"]);
        $newfilename = "P00001" . '.' . end($temp);
        move_uploaded_file($_FILES["file"]["tmp_name"], "product_pic/" . $newfilename);
        
    } 
} 
?>