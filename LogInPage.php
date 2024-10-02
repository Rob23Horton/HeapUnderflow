<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Heap Underflow</title>

	<link href="style/style.css" rel="stylesheet" type="text/css">
	
	<script src="javascript/LogInPage.js"></script>

</head>

<body>

	<?php
		include("scripts/header.php");

		if (isset($_COOKIE["key"]))
		{
			header("location: scripts/MovePage.php?MoveToHomePage=Home");
		}
	?>

	<div style="text-align: center">
		<div class="box-flex & box-style">			
			<h1>Log In</h1>
			<b1>
				<form method="post" action="scripts/LogIn.php">
					<p class="vertical-box-item">
						<input type="text" name="username" id="username" placeholder="Username" required oninput="checkEnteredValid()">
					</p>
					<p class="vertical-box-item">
						<input type="password" name="password" id="password" placeholder="Password" required oninput="checkEnteredValid()">
					</p>
					<p class="vertical-box-item">
						Show Password
						<input type="checkbox" unchecked onclick="showPassword()">
					</p>
					<p class="vertical-box-item">
						<input type="submit" class="header-button-style & button-update" value="Log In">
					</p>

					
				</form>
				<form method="post" action="scripts/MovePage.php">
					<p class="vertical-box-item">
						<input type="submit" class="header-button-style & button-update" name="MoveToAccountPage" value="Create Account">
					</p>
				</form>

				<?php 
					if (isset($_GET["error"]))
					{
						if ($_GET["error"] == "accountdoesntexist")
						{
							echo "<p>Account doesn't exist, please try again or create an account.</p>";
						}
					}
				
				?>
			</b1>
		</div>
	</div>
</body>
</html>
