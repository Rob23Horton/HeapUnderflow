<?php


if (!isset($_POST["imageId"]))
{
    header("location: ../scripts/MovePage.php?MoveTo=Home");
    exit();
}


include_once("connection.php");
include_once("ImageFunctions.php");

$encode = GetImageFromId($conn, $_POST["imageId"]);


$fileName = "Image.JPG";

if (isset($_POST["fileName"]))
{
    $fileName = $_POST["fileName"] . ".JPG";
}

header('Content-Type: image/jpeg');
header('Content-Disposition: attachment; filename="'.$fileName.'"');

$exploded = explode(',', $encode, 2); // limit to 2 parts, i.e: find the first comma
$encoded = $exploded[1]; // pick up the 2nd part
$decoded = base64_decode($encoded);

$img_handler = imagecreatefromstring($decoded); //Creates the stream

echo imagejpeg($img_handler); //Creates the data and prints it

?>