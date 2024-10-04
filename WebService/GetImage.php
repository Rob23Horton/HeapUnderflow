<?php


//This is TODO in the future when the authorisation key is incorrect
// header('HTTP/1.1 401 Unauthorized', true, 401);
// exit();

header('Content-Type: application/json; charset=utf-8');


//Checks if image_id exists and if it doesn't stops and sends back bad request
if (!isset($_GET["image_id"]))
{
    include("../scripts/BadRequest.php");
}


$image_id = $_GET["image_id"];

include_once("../scripts/connection.php");
if ($conn == null)
{
    include("../scripts/BadRequest.php");
}

include_once("../scripts/ImageFunctions.php");
$image_data = GetImageFromId($conn, $image_id);

if ($image_data == "")
{
    include("../scripts/BadRequest.php");
}

echo '{"image_data": "'.$image_data.'" })';

?>