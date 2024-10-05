<?php

header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET["definition_id"]))
{
    include($_SERVER['DOCUMENT_ROOT']."/scripts/BadRequest.php");
}

$definition_id = $_GET["definition_id"];

include_once($_SERVER["DOCUMENT_ROOT"]."/scripts/connection.php");

if ($conn == null)
{
    include($_SERVER['DOCUMENT_ROOT']."/scripts/BadRequest.php");   
}

include_once($_SERVER["DOCUMENT_ROOT"]."/scripts/DefinitionFunctions.php");
$definition_images = GetImageCodesForDefinition($conn, $definition_id);


echo '{ "image_ids":[';

if (sizeof($definition_images) > 0)
{
    echo json_encode(array_pop($definition_images));

    foreach ($definition_images as $id)
    {
        echo ', ' . json_encode($id);
    }
}

echo "] }";

?>