<?php

if (!isset($_POST["change"]))
{
	header("location: ../scripts/MovePage.php?MoveTo=Home");
	exit();
}

include_once("connection.php");
include_once("UserFunctions.php");
include_once("KeyFunctions.php");

if (!isset($_COOKIE["key"]))
{
	header("location: ../scripts/MovePage.php?MoveTo=Home");
	exit();
}

$userId = GetUserIdFromKey($conn, $_COOKIE["key"]);

$username = GetUsernameFromId($conn, $userId);

$hashedPassword = HashPassword($username, $_POST["password"]);

$dbPassword = GetPasswordFromId($conn, $userId);

echo $username;
echo "<br>";

if ($hashedPassword != $dbPassword)
{
	header("location: ../AccountPage.php?error=passwordincorrect");
	exit();
}

if ($_POST["change"] == "Change Username")
{
	$newUsername = $_POST["newUsername"];

	//TODO - Check if user already exists ------------------------------
	if (UserExists($conn, $newUsername))
	{
		header("location: ../AccountPage.php?error=UsernameIsAlreadyUsed");
		exit();
	}

	$newPassword = HashPassword($newUsername, $_POST["password"]);

	ChangeUsernameFromId($conn, $userId, $newUsername);
	ChangePasswordFromId($conn, $userId, $newPassword);
}
else if ($_POST["change"] == "Change Password")
{
	$newPassword = HashPassword($username, $_POST["newPassword"]);

	ChangePasswordFromId($conn, $userId, $newPassword);
}
else if ($_POST["change"] == "Delete Account")
{
    include_once("UserInfoFunctions.php");
    include_once("ImageFunctions.php");

    $image_code = GetProfileImageCodeFromUserCode($conn, $userId);
    DeleteOldImage($conn, $image_code, $userId);
    DeleteUserInfo($conn, $userId);

	ChangePasswordFromId($conn, $userId, 'None');
	ChangeUsernameFromId($conn, $userId, 'DeletedUser');
	DeleteKeyForUser($conn, $_COOKIE["key"]);
	DeleteKeyFromCookie();

	header("location: ../scripts/MovePage.php?MoveTo=Home");
	exit();
}

header("location: ../scripts/MovePage.php?MoveTo=Account");

?>