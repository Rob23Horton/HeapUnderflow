<?php

function CreateNewUserInfo($conn, $user_id)
{
    $sql = "INSERT INTO tblUserInformation (user_code, profile_image_code) VALUES ('$user_id', '1');";

    mysqli_query($conn, $sql);
}

function SetProfileImageCode($conn, $user_code, $image_code)
{
    $sql = "UPDATE tblUserInformation SET profile_image_code = '$image_code' WHERE (user_code = '$user_code');";

    mysqli_query($conn, $sql);
}

function GetProfileImageCodeFromUserCode($conn, $user_code)
{
    $sql = "SELECT profile_image_code FROM tblUserInformation WHERE user_code = '$user_code';";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0)
    {
        return 1;
    }

    return mysqli_fetch_assoc($result)["profile_image_code"];
}

function DeleteUserInfo($conn, $user_code)
{
    $sql = "UPDATE tblUserInformation SET profile_image_code = '1' WHERE (user_code = '$user_code');";

    mysqli_query($conn, $sql);
}

function GetAllImageCodesWhereNotUser($conn, $user_code)
{
    $sql = "SELECT profile_image_code FROM tblUserInformation WHERE user_code != '$user_code';";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0)
    {
        return [];
    }

    $returnImages = [];

    while ($currImage = mysqli_fetch_assoc($result)["profile_image_code"])
    {
        array_push($returnImages, $currImage);
    }

    return $returnImages;
}

function GetAllUserCodesFromImageCode($conn, $image_code)
{
    $sql = "SELECT user_code FROM tblUserInformation WHERE profile_image_code = $image_code;";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0)
    {
        return [];
    }

    $user_codes = [];

	while ($user_code = mysqli_fetch_assoc($result)["user_code"])
	{
		array_push($user_codes, $user_code);
	}

    return $user_codes;
}


?>