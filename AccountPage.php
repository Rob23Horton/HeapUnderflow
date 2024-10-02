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
						include("scripts/connection.php");
						include_once("scripts/KeyFunctions.php");
						include_once("scripts/UserFunctions.php");

						echo '<script type="text/JavaScript">console.log("Not moving to home - DEBUGGING");</script>';

						if (!isset($_COOKIE["key"]))
						{
							header("location: scripts/MovePage.php?MoveToHomePage=Home");
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
						}

						echo "<h3>Username</h3>
							<b2>
								<p>
									Current - $username
								</p>
								<p>
									<input type='submit' class='header-button-style & button-update' value='Change Username' name='change'>
								</p>
							</b2>";

						echo "<h4>Password</h4><b3><input type='submit' class='header-button-style & button-update' value='Change Password' name='change'></b3>";

						echo "<h5>Delete Account</h5><b4><input type='submit' class='header-button-style & button-update' value='Delete Account' name='change'></b4>";
				
					?>
				
				</form>

			</b1>

		</div>
	</div>
</body>
</html>