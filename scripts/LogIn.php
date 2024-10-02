<?php

include_once("connection.php");
include_once("UserFunctions.php");
include_once("KeyFunctions.php");


$username = $_POST["username"];
$password = $_POST["password"];
$hashedPassword = HashPassword($username, $password);

echo "<br>Checking user exists";

if (!UserExists($conn, $username))
{
	header("location: ../LogInPage.php?error=accountdoesntexist");
	exit();
}

echo "<br>Getting user id";

$userId = GetUserId($conn, $username, $hashedPassword);

echo "<br>Checking user exists";

if ($userId == null)
{
	header("location: ../LogInPage.php?error=accountdoesntexist");
	exit();
}

echo "<br>Checking for session key";

$userKey = GetKeyForUser($conn, $userId);

if ($userKey != null)
{
	AddKeyToCookie($userKey);

	header("location: ../scripts/MovePage.php?MoveToHomePage=Home");
	exit();
}

echo "<br>Creating session key";

$userKey = CreateKeyForUser($conn, $userId);
AddKeyToCookie($userKey);

echo "<br>Created session key";


header("location: ../scripts/MovePage.php?MoveToHomePage=Home");

?>