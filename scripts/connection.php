<?php
include_once("DBCredentials.php");

$conn = mysqli_connect($location, $username, $password, 'heapunderflow');

if (!$conn)
{
	echo "Error: Unable to connect to MySQL".PHP_EOL;
	echo "Debugging errno: " . mysqli_connect.errno().PHP_EOL;
	echo "Debugging error: " . mysqli_connect.error().PHP_EOL;
	$conn = null;
	exit;
}

$cookieChanged = false;

if (isset($_COOKIE["key"]))
{
	include_once("KeyFunctions.php");
	include_once("UserFunctions.php");

	if (!CheckKeyIsValid($_COOKIE["key"]))
	{
		$cookieChanged = true;
		DeleteKeyFromCookie();
	}
	else if (GetUserIdFromKey($conn, $_COOKIE["key"]) == null)
	{
		$cookieChanged = true;
		DeleteKeyFromCookie();
	}

}

?>