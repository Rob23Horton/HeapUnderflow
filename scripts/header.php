<link href="../style/style.css" rel="stylesheet" type="text/css">

<header class="header-style">
	<div style="padding-top:1%">
		<div style="align-self:center">
			
            <a class="header-button-style & button-update & horizontal-box-item & link-button" style="text-align:center" href="../">Home</a>
        
            <?php
            
                if (!isset($_COOKIE["key"]))
                {
                    echo '<a class="header-button-style & button-update & horizontal-box-item & link-button" style="text-align:center" href="../LogInPage.php">Log In</a>';
                }
                else
                {
                    echo '<a class="header-button-style & button-update & horizontal-box-item & link-button" style="text-align:center" href="../CreateOptionsPage.php">Create</a>';
                    echo '<a class="header-button-style & button-update & horizontal-box-item & link-button" style="text-align:center" href="../AccountPage.php">Account</a>';
                    echo '<a class="header-button-style & button-update & horizontal-box-item & link-button" style="text-align:center" href="LogOutPage.php">Log Out</a>';
                }
            ?>
		</div>
	</div>
</header>
