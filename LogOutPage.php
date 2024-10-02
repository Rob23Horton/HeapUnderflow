<?php

if (isset($_COOKIE["key"]))
{
	$key = $_COOKIE["key"];

	setcookie('key', null, 1, '/');

	include_once("scripts/KeyFunctions.php");
	include_once("scripts/connection.php");

	DeleteKeyForUser($conn, $key);
    DeleteKeyFromCookie();
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

    <?php
        include_once("scripts/header.php");
    ?>

	<!--Redirects the user back to home page after 15 seconds because it's cool ;)-->
	<script type="text/javascript">
		var myTimer = window.setTimeout(timer, 15000);

		function timer() {
			window.location.href = "scripts/MovePage.php?MoveTo=Home";
		}
	</script>

	<div style="text-align: center">
		<div class="box-flex & box-style">
			<p>You have been logged out</p>
		</div>
	</div>


</body>
</html>