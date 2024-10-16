<?php

header('Content-Type: application/json; charset=utf-8');

if (!isset($_POST["image_data"]))
{
    echo '{ "error":"No Image Data Provided."}';
    include($_SERVER['DOCUMENT_ROOT']."/scripts/BadRequest.php");
}

$image_data = $_POST["image_data"];


if (strlen($image_data) > 16_777_215) //16 MB
{
    echo '{ "error":"Image was too large." }';
    include($_SERVER['DOCUMENT_ROOT']."/scripts/BadRequest.php");
}
else if (strlen($image_data) == 0)
{
    echo '{ "error":"Image data was blank." }';
    include($_SERVER['DOCUMENT_ROOT']."/scripts/BadRequest.php");
}

include($_SERVER['DOCUMENT_ROOT']."/scripts/connection.php");

if ($conn == null)
{
    include($_SERVER['DOCUMENT_ROOT']."/scripts/BadRequest.php");
}


$keep = isset($_POST["keep"]) ? $_POST["keep"] : 0;


include_once($_SERVER['DOCUMENT_ROOT']."/scripts/ImageFunctions.php");

//Have to make sure that image is the same as what would be in the db
$image_file_meta_data = explode(",", $image_data)[0];
$file = explode(",", $image_data)[1];
$image_data = $image_file_meta_data . "," . ResizeBase64Image($image_data, 1500);

$image_id = GetImageIdFromData($conn, $image_data);

if ($image_id == -1)
{
    //Saves image and gets the id for the image
    SaveImage($conn, $image_data, $keep);
    $image_id = GetImageIdFromData($conn, $image_data);
}

echo '{ "image_id":' . $image_id . ' }';

?>