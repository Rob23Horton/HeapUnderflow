<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Heap Underflow</title>
	
	<link href="style/style.css" rel="stylesheet" type="text/css">

	<script src="javascript/CreateAccountPage.js"></script>
	
</head>

<body>
	
	<?php
		include("scripts/header.php");
	?>
	
	<div style="text-align: center">
		<div class="box-flex & box-style">
			<h1>Create Account</h1>
			<b1>
				<form method="post" action="scripts/CreateAccount.php">
					<div class="vertical-box-item">
						<input type="text" id="username" name="username" placeholder="Username" required oninput="checkEnteredValid()">
					</div>
					<div class="vertical-box-item">
						<input type="password" name="password" id="password" placeholder="Password" required oninput="checkEnteredValid()">
					</div>
					
					<div class="vertical-box-item">
						<input type="password" id="passwordRetype" placeholder="Password Retyle" required oninput="checkEnteredValid()">
					</div>
					<p class="vertical-box-item">
						Show password
						<input type="checkbox" unchecked onclick="showPassword()">
					</p>
					<div class="vertical-box-item">
						<input type="submit" class="header-button-style & button-update" value="Create Account">
					</div>
				</form>

				<?php
					if (isset($_GET["error"]))
					{
						if ($_GET["error"] == "useralreadyexists")
						{
							echo "<div class='vertical-box-item'><p>Account already exists, please pick another username.</p></div>";
						}
					}
				?>
			</b1>
		</div>
	</div>
	
</body>
</html>

