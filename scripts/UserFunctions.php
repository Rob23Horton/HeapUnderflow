<?php

function HashPassword($username, $password)
{
	$passwordToHash = substr($username, 0, 3) . $password;
	return hash("md5", $passwordToHash, false);
}

function UserExists($conn, $username)
{

	$sql = "SELECT * FROM tblUsers WHERE username = '$username'";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0)
	{
		return true;
	}

	return false;
}

function CreateUser($conn, $username, $password)
{
	$sql = "INSERT INTO `tblUsers` (`username`, `password`) VALUES ('$username', '$password');";

	mysqli_query($conn, $sql);
}

function GetUserId($conn, $username, $password)
{
	if (!UserExists($conn, $username))
	{
		return;
	}

	$sql = "SELECT user_id FROM tblUsers WHERE username = '$username'AND password = '$password';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return;
	}

	$user_id = mysqli_fetch_assoc($result)["user_id"];

	return $user_id;
}


function GetUsernameFromId($conn, $userId)
{
	$sql = "SELECT * FROM tblUsers WHERE user_id = '$userId'";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return;
	}

	$username = mysqli_fetch_assoc($result)["username"];

	return $username;
}

function GetPasswordFromId($conn, $userId)
{
	$sql = "SELECT * FROM tblUsers WHERE user_id = '$userId'";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return;
	}

	$password = mysqli_fetch_assoc($result)["password"];

	return $password;
}

function ChangeUsernameFromId($conn, $userId, $username)
{
	$sql = "UPDATE tblUsers SET `username` = '$username' WHERE (`user_id` = '$userId');";

	mysqli_query($conn, $sql);
}

function ChangePasswordFromId($conn, $userId, $password)
{
	$sql = "UPDATE tblUsers SET `password` = '$password' WHERE (`user_id` = '$userId');";

	mysqli_query($conn, $sql);
}
?>