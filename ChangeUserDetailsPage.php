<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Heap Underflow</title>

	<link href="style/style.css" rel="stylesheet" type="text/css">

	<script src="javascript/ChangeUserDetailsPage.js"></script>

</head>

<body>

	<?php
		include("scripts/header.php");
		
		if (!isset($_COOKIE["key"]))
		{
			header("location: ../scripts/PageMove.php?MoveToHomePage=Home");
			exit();
		}
	?>

	<div style="text-align: center">
		<div class="box-flex & box-style">
			<form method="post" action="scripts/ChangeUserDetails.php">
				<?php
					echo "<h1>" . $_POST['change'] . "</h1>";


					echo '<b1><p><input type="password" id="password" name="password" placeholder="Password" required oninput="checkPasswordValid()"></p>';
					echo '<p>Show password - <input type="checkbox" unchecked onchange="showPassword()"></p>';

					if ($_POST['change'] == "Change Username")
					{
						echo '<p><input type="text" id="newUsername" name="newUsername" placeholder="New Username" required oninput="checkUsernameValid()"></p>';
						echo '<p><input type="submit" class="header-button-style & button-update" name="change" value="Change Username"></p>';
					}
					else if ($_POST['change'] == "Change Password")
					{
						echo '<p><input type="password" id="newPassword" name="newPassword" placeholder="New Password" required oninput="checkNewPasswordValid()"></p>';
						echo '<p><input type="password" id="newPasswordRetype" placeholder="New Password Retype" required oninput="checkNewPasswordValid()"></p>';
						echo '<p>Show new password - <input type="checkbox" unchecked onchange="showNewPassword()"></p>';
						echo '<p><input type="submit" class="header-button-style & button-update" name="change" value="Change Password"></p>';
					}
					else if ($_POST['change'] == "Delete Account")
					{
						echo '<p><input type="submit" class="header-button-style & button-update" name="change" value="Delete Account"></p>';
					}
				?>

				</b>
			</form>
		</div>
	</div>
</body>
</html>