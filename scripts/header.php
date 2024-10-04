<link href="../style/style.css" rel="stylesheet" type="text/css">

<header class="header-style">
	<div style="padding-top:1%">
		<div style="align-self:center">
			
            <a class="header-button-style & button-update & horizontal-box-item & link-button" style="text-align:center" href="../">Home</a>
        
            <?php
            
                if (!isset($_COOKIE["key"]))
                {
                    echo '<a class="header-button-style & button-update & horizontal-box-item & link-button" style="text-align:center" href="../Pages/LogInPage.php">Log In</a>';
                }
                else
                {
                    echo '<a class="header-button-style & button-update & horizontal-box-item & link-button" style="text-align:center" href="../Pages/CreateOptionsPage.php">Create</a>';
                    echo '<a class="header-button-style & button-update & horizontal-box-item & link-button" style="text-align:center" href="../Pages/AccountPage.php">Account</a>';
                    echo '<a class="header-button-style & button-update & horizontal-box-item & link-button" style="text-align:center" href="../Pages/LogOutPage.php">Log Out</a>';
                }
            ?>

            <a class="header-button-style & button-update & horizontal-box-item & link-button" style="text-align:center" href="../Pages/InformationPage.php">Information</a>
		</div>
	</div>
</header>
