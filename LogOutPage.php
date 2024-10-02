<?php
include("scripts/header.php");

if (isset($_COOKIE["key"]))
{
	$key = $_COOKIE["key"];

	setcookie('key', null, 1, '/');

	//TODO - Remove key from local storage if it is in there

	include("scripts/KeyFunctions.php");
	include_once("scripts/connection.php");

	DeleteKeyForUser($conn, $key);

	header("location: ../LogOutPage.php");
}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Heap Underflow</title>

	<link href="style/style.css" rel="stylesheet" type="text/css">

</head>

<body>
	

	<div style="text-align: center">
		<div class="box-flex & box-style">
			<p>You have been logged out</p>
		</div>
	</div>


</body>
</html>