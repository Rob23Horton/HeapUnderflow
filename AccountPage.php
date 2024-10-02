<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Heap Underflow</title>

	<link href="style/style.css" rel="stylesheet" type="text/css">

</head>

<body>

	<?php
		include("scripts/header.php");		
	?>

	<div style="text-align: center">
		<div class="box-flex & box-style">
			<h1>Account</h1>
			<b1>
				<form method="post" action="ChangeUserDetailsPage.php">

					<?php
						include_once("scripts/connection.php");
						include_once("scripts/KeyFunctions.php");
						include_once("scripts/UserFunctions.php");

						if (!isset($_COOKIE["key"]))
						{
							header("location: scripts/MovePage.php?MoveTo=Home");
							exit();
						}

						$userId = GetUserIdFromKey($conn, $_COOKIE["key"]);

						$username = GetUsernameFromId($conn, $userId);

						if (isset($_GET["error"]))
						{
							if ($_GET["error"] == "passwordincorrect")
							{
								echo "<h2>Password was incorrect. Please try again.</h2>";
							}
							else if ($_GET["error"] == "UsernameIsAlreadyUsed")
							{
								echo "<h2>Username is already being used. Please try again.</h2>";
							}
						}

						echo "<h2>Username</h2>
							<b1>
								<p>
									Current - $username
								</p>
								<p>
									<input type='submit' class='header-button-style & button-update' value='Change Username' name='change'>
								</p>
							</b1>";

						echo "<h2>Password</h2><b1><input type='submit' class='header-button-style & button-update' value='Change Password' name='change'></b1>";

						echo "<h2>Delete Account</h2><b1><input type='submit' class='header-button-style & button-update' value='Delete Account' name='change'></b1>";
				
					?>
				
				</form>

			</b1>

		</div>
	</div>
</body>
</html>