<?php

$defaultImage = 1;

function SaveImage($conn, $image_data, $keep)
{
    $image_data = mysqli_escape_string($conn, $image_data);
    $keep = (int)$keep;

    $sql = "INSERT INTO tblImages (image_data, keep) VALUES ('$image_data', $keep);";

    mysqli_query($conn, $sql);

}

function GetImageFromId($conn, $image_id)
{
    $sql = "SELECT image_data FROM tblImages WHERE image_id = $image_id;";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0)
    {
        return "";
    }

    return mysqli_fetch_assoc($result)["image_data"];
}

function ImageExist($conn, $image_data)
{
    if (GetImageIdFromData($conn, $image_data) == -1)
    {
        return false;
    }
    return true;
}

function GetImageIdFromData($conn, $image_data)
{
    $image_data = mysqli_escape_string($conn, $image_data);
    $sql = "SELECT image_id FROM tblImages WHERE image_data = '$image_data';";

    //echo $sql;

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0)
    {
        return -1;
    }

    $image_id = mysqli_fetch_assoc($result)['image_id'];

    return $image_id;
}

function GetDeleteFromImageId($conn, $image_id)
{
    $sql = "SELECT keep FROM tblImages WHERE image_id = $image_id;";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0)
    {
        return true;
    }

    $keep = mysqli_fetch_assoc($result)["keep"];

    if ($keep)
    {
        return false;
    }
    return true;
}

function DeleteImage($conn, $image_id)
{
    $sql = "DELETE FROM tblImages WHERE image_id = $image_id;";

    mysqli_query($conn, $sql);
}

function ResizeBase64Image($base64Str, $maxDimension) {

    // Decode base64 string
    $imageData = base64_decode($base64Str);

    // Create an image from the string
    $srcImage = imagecreatefromstring($imageData);

    if ($srcImage == false) {
        echo 'Failed to create image from base64 string';
        return $base64Str;
    }

    // Get original dimensions
    list($width, $height) = getimagesizefromstring($imageData);

    $ratio = $width / $height;
    $newWidth = $maxDimension;
    $newHeight = $newWidth / $ratio;

    // Create a new empty image with the new dimensions
    $newImage = imagecreatetruecolor($newWidth, $newHeight);

    // Resize the image
    imagecopyresampled($newImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if ($newHeight > $newWidth)
    {
        imagerotate($newImage, 180, 0);
    }

    // Output the resized image as a base64 string
    ob_start();
    imagejpeg($newImage); // You can use imagepng() or imagegif() for other formats
    $resizedImageData = ob_get_contents();
    ob_end_clean();

    // Clean up memory
    imagedestroy($srcImage);
    imagedestroy($newImage);

    // Convert resized image to base64
    $resizedBase64 = base64_encode($resizedImageData);

    return $resizedBase64;
}


function DeleteOldImage($conn, $image_code, $user_code)
{
    include_once("UserInfoFunctions.php");
    include_once("DefinitionFunctions.php");

    $delete = true;

        $delete = GetDeleteFromImageId($conn, $image_code);

        if ($delete == true)
        {
            $imageUserCodes = GetAllImageCodesWhereNotUser($conn, $user_code);
            $imageDefinitionCodes = GetAllImageCodesForDefinitions($conn);

            if (in_array($image_code, $imageUserCodes))
            {
                echo "User";
                $delete = false;
            }
            else if (in_array($image_code, $imageDefinitionCodes))
            {
                echo "Definition";
                $delete = false;
            }
        }

        if ($delete == true)
        {
            DeleteImage($conn, $image_code);
        }
}

?>