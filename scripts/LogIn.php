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
	header("location: ../Pages/LogInPage.php?error=accountdoesntexist");
	exit();
}

echo "<br>Getting user id";

$userId = GetUserId($conn, $username, $hashedPassword);

echo "<br>Checking user exists";

if ($userId == null)
{
	header("location: ../Pages/LogInPage.php?error=accountdoesntexist");
	exit();
}

echo "<br>Checking for session key";

$userKeys = GetKeysForUser($conn, $userId);

//Deletes all keys that are to do with another device from db
if (sizeof($userKeys) > 0)
{
	$invalidKeys = [];

	foreach ($userKeys as $key)
	{
		//Make sure not to delete app keys due to them being different things
        //(Want to keep them seperate)
		if (CheckKeyIsApp($key) == true) 
        {
            array_push($invalidKeys, $key);
        }
		else if (!CheckKeyIsValid($key))
		{
			DeleteKeyForUser($conn, $key);
			array_push($invalidKeys, $key);
		}
        
        
	}

	$userKeys = array_diff($userKeys, $invalidKeys);
}

if (sizeof($userKeys) == 1)
{
	AddKeyToCookie(array_values($userKeys)[0]);

	header("location: ../scripts/MovePage.php?MoveToHomePage=Home");
	exit();
}

echo "<br>Creating session key";

$userKey = CreateKeyForUser($conn, $userId);
AddKeyToCookie($userKey);

echo "<br>Created session key";

if (isset($_POST["returnLocation"]))
{
    header("location: ". $_POST["returnLocation"]);
    exit();
}

header("location: ../scripts/MovePage.php?MoveToHomePage=Home");

?>