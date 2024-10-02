<?php
include_once("DBCredentials.php");

$conn = mysqli_connect($locaiton, $username, $password, 'heapunderflow');

if (!$conn)
{
	echo "Error: Unable to connect to MySQL".PHP_EOL;
	echo "Debugging errno: " . mysqli_connect.errno().PHP_EOL;
	echo "Debugging error: " . mysqli_connect.error().PHP_EOL;
	exit;
}

if (isset($_COOKIE["key"]))
{
	include_once("KeyFunctions.php");

	if (GetUserIdFromKey($conn, $_COOKIE["key"]) == null)
	{
		DeleteKeyFromCookie();
	}

}

?>