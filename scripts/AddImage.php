<?php

if (!isset($_POST["fileData"]))
{
    header("location: ../scripts/MovePage.php?MoveTo=Home");
    exit();
}

$file = $_POST["fileData"];
if (isset($_POST["returnLocation"]))
{
    $returnLocation = $_POST["returnLocation"];
}
else
{
    $returnLocation = "../";
}

if (strlen($file) > 16_777_215) //16 MB
{
    if (strpos($returnLocation, "?") == false)
    {
        header("location: $returnLocation?error=FileTooLarge");
    }
    else
    {
        header("location: $returnLocation&error=FileTooLarge");
    }

    exit();
}
else if (strlen($file) == 0)
{
    if (strpos($returnLocation, "?") == false)
    {
        header("location: $returnLocation?error=FileTooSmall");
    }
    else
    {
        header("location: $returnLocation&error=FileTooSmall");
    }

    exit();
}

include_once("connection.php");

if (!isset($_COOKIE["key"]))
{
    header("location: $returnLocation");
    exit();
}

$keep = 0;

if (isset($_POST["keepImage"]))
{
    $keep = $_POST["keepImage"];
}



include_once("ImageFunctions.php");

$fileMeta = explode(",", $file)[0]; //Have to make sure that image is the same as what would be in the db
$file = explode(",", $file)[1];
$file = $fileMeta . "," . ResizeBase64Image($file, 1500);

$image_id = GetImageIdFromData($conn, $file);

if ($image_id == -1)
{
    //Saves image and gets the id for the image
    SaveImage($conn, $file, $keep);
    $image_id = GetImageIdFromData($conn, $file);
}

if (isset($_POST["uploadType"]))
{
    if ($_POST["uploadType"] == "Profile") //Changes the profile picture for the user
    {
        include_once("UserInfoFunctions.php");
        include_once("KeyFunctions.php");

        $user_code = GetUserIdFromKey($conn, $_COOKIE["key"]);

        $old_image_code = GetProfileImageCodeFromUserCode($conn, $user_code);

        SetProfileImageCode($conn, $user_code, $image_id);
        
        //Delete old image (if not keep and if no one else is using it)
        DeleteOldImage($conn, $old_image_code, $user_code);

    }
    else if ($_POST["uploadType"] == "Definition") //Adds the image to the definition
    {
        include_once("DefinitionFunctions.php");

        $definitionCode = $_POST["definitionCode"];

        CreateDefinitionFile($conn, $definitionCode, 'i', $image_id);
    }

    //More Upload Types Here
}

header("location: $returnLocation");

exit();

?>