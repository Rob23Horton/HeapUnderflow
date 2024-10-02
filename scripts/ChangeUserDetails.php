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
	ChangePasswordFromId($conn, $userId, 'None');
	ChangeUsernameFromId($conn, $userId, 'DeletedUser');
	DeleteKeyForUser($conn, $_COOKIE["key"]);
	DeleteKeyFromCookie();

	header("location: ../scripts/MovePage.php?MoveTo=Home");
	exit();
}

header("location: ../scripts/MovePage.php?MoveTo=Account");

?>