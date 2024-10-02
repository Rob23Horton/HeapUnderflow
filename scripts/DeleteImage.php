<?php



if (isset($_POST["returnLocation"]))
{
    $returnLocation = $_POST["returnLocation"];
}
else
{
    $returnLocation = "../scripts/MovePage.php?MoveTo=Home";
}

if (!isset($_POST["imageId"]))
{
    header("location: $returnLocation");
    exit();
}

$imageId = $_POST["imageId"];

include_once("connection.php");

if (!isset($_COOKIE["key"]))
{
    header("location: $returnLocation");
}

include_once("ImageFunctions.php");
include_once("DefinitionFunctions.php");

$userCode = $_POST["userCode"];
$definitionId = $_POST["definitionId"];

DeleteDefinitionFileFromDefinitionIdAndImageCodeAndUserCode($conn, $definitionId, $imageId, $userCode);
DeleteOldImage($conn, $imageId, -1);

header("location: $returnLocation");


?>