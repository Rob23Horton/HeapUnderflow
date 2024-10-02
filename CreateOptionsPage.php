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

		if (!isset($_COOKIE["key"]))
		{
			header("location: scripts/MovePage.php?MoveTo=Home");
			exit();
		}
	?>

	<div style="text-align: center">
		<div class="box-flex & box-style">
				<h1>Create</h1>

				<b1>
					<form method="post" action="../CreatePage.php">

						<input name="From" value="CreateOptions" hidden>
						
						<div class="vertical-box-item">
							<input type="submit" class="header-button-style & button-change" name="create" value="Create Topic">
						</div>
			
						<div class="vertical-box-item">
							<input type="submit" class="header-button-style & button-change" name="create" value="Create Subject">
						</div>
						
						<div class="vertical-box-item">
							<input type="submit" class="header-button-style & button-change" name="create" value="Create Definition">
                        </div>
						

					</form>

                    <?php
                    
                    if (isset($_GET["error"]))
                    {
                        $error = $_GET["error"];

                        if ($error == "topicalreadyexists")
                        {
                            echo '<h2>Topic Already Exists!</h2>';
                        }
                        else if ($error == "subjectalreadyexists")
                        {
                            echo '<h2>Subject Already Exists!</h2>';
                        }
                    }
                    
                    ?>
				</b1>

		</div>
	</div>
</body>
</html>