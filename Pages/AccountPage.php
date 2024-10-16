<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Heap Underflow</title>

	<link href="../style/style.css" rel="stylesheet" type="text/css">

    <script src="../javascript/UploadImage.js"></script>
	<script src="../javascript/AccountPage.js"></script>
</head>

<body>

	<?php
		include("../scripts/header.php");		
	?>

	<div style="text-align: center">
		<div class="box-flex & box-style">
			<h1>Account</h1>
			<b1>

            <h2>Profile Picture</h2>
            <div>
                <?php
                    include_once("../scripts/connection.php");

                    if (!isset($_COOKIE["key"]))
                    {
                        header("location: ../scripts/MovePage.php?MoveTo=Home");
                        exit();
                    }

                    include_once("../scripts/KeyFunctions.php");
                    include_once("../scripts/UserInfoFunctions.php");
                    include_once("../scripts/ImageFunctions.php");

                    $userId = GetUserIdFromKey($conn, $_COOKIE["key"]);

                    $imageCode = GetProfileImageCodeFromUserCode($conn, $userId);
					echo '<p id="image_id" hidden>'.$imageCode.'</p>';

                    echo '<img style="width:100%;height:auto;max-width:50%;border:2px solid black;border-radius:250px" id="imagePreview">';

                ?>
            </div>

            <form method="post" action="../scripts/AddImage.php">
                <input type="file" id="fileInput" oninput="ImageChanged()">
                <input type="text" name="fileData" id="fileData" hidden> <!--Actual Data -->
                <input type="text" name="uploadType" value="Profile" hidden> <!-- Image Type -->
                <input type="text" name="returnLocation" value="../Pages/AccountPage.php" hidden> <!-- Return Location -->
                <?php
                    if (isset($_GET["error"]))
                    {
                        if ($_GET["error"] == "FileTooLarge")
                        {
                            echo '<p>File Selected Was Too Large</p>';
                        }
                        else if ($_GET["error"] == "FileTooSmall")
                        {
                            echo '<p>No File Was Selected</p>';
                        }
                    }
                ?>
                <div><input type="submit" class="header-button-style & button-update" value="Upload Image"></div>
            </form>


				<form method="post" action="ChangeUserDetailsPage.php">

					<?php
						include_once("../scripts/connection.php");
						include_once("../scripts/KeyFunctions.php");
						include_once("../scripts/UserFunctions.php");

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