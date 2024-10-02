<link href="../style/style.css" rel="stylesheet" type="text/css">

<header class="header-style">
	<div style="padding-top:1%">
		<div style="align-self:center">
			
			
			<form action="../scripts/MovePage.php" method="post">
			
				<input type="submit" class="header-button-style & button-update" name="MoveToHomePage" value="Home">
			
				<?php
				
					if (!isset($_COOKIE["key"]))
					{
						echo '<input type="submit" class="header-button-style & button-update" name="MoveToLogInPage" value="Log In">';
					}
					else
					{
						echo '<input type="submit" class="header-button-style & button-update" name="MoveToAccountPage" value="Account">';
						echo '<input type="submit" class="header-button-style & button-update" name="MoveToLogOutPage" value="Log Out">';
					}
				?>
			</form>
		</div>
	</div>
</header>
