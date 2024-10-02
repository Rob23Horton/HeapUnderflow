<?php

function GetKeyForUser($conn, $userId)
{
	$sql = "SELECT * FROM tblCurrentKeys WHERE user_code = '$userId';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return null;
	}

	$key = mysqli_fetch_assoc($result)["key"];

	return $key;
}

function GetKeysForUser($conn, $userId)
{
	$sql = "SELECT * FROM tblCurrentKeys WHERE user_code = '$userId'";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return [];
	}

	$keyArr = [];

	while ($rowUserId = mysqli_fetch_assoc($result)["key"])
	{
		array_push($keyArr, $rowUserId);
	}

	return $keyArr;
}


function CreateKeyForUser($conn, $userId)
{
	$ipAddress = $_SERVER["REMOTE_ADDR"];

	$time = time();

	$hashedIpAddress = HashPassword(strval($time), strval($ipAddress));

	$key = $hashedIpAddress . "" . strval($time);

	echo "<script>console.log('$key');</script>";


	$sql = "INSERT INTO tblCurrentKeys (`key`, `user_code`) VALUES ('$key', $userId);";

	mysqli_query($conn, $sql);
	
	return $key;
	
}

function CheckKeyIsValid($key)
{
	$keyTime = substr($key, -10);

	$keyIpAddr = str_replace($keyTime, "", $key);

	$clientIpAddr = strval($_SERVER["REMOTE_ADDR"]);

	$clientIpAddr = HashPassword($keyTime, $clientIpAddr);

	if ($keyIpAddr != $clientIpAddr)
	{
		return false;
	}
	return true;
}

function DeleteKeyForUser($conn, $key)
{
	$sql = "SELECT * FROM tblCurrentKeys as k WHERE k.key = '$key';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return;
	}

	$keyId = mysqli_fetch_assoc($result)["currentkeys_id"];

	$sql = "DELETE FROM tblCurrentKeys WHERE currentkeys_id = '$keyId';";

	mysqli_query($conn, $sql);
	
	echo "<script type='text/JavaScript'>console.log('Cookie deleted')</script>";
}

function AddKeyToCookie($key)
{
	setcookie("key", $key, time() + (86400 * 30), "/");
	echo '<script type="text/JavaScript">console.log("Cookie made - DEBUGGING");</script>';
}

function DeleteKeyFromCookie()
{
	unset($_COOKIE["key"]);
	setcookie("key", null, time() - 36000, "/");
	echo '<script type="text/JavaScript">console.log("Cookie deleted - DEBUGGING");</script>';
}

function GetUserIdFromKey($conn, $key)
{

	$sql = "SELECT user_code FROM tblCurrentKeys as k WHERE k.key = '$key'";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return null;
	}

	$userId = mysqli_fetch_assoc($result)["user_code"];

	return $userId;
}

?>