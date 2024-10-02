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

		include_once("scripts/connection.php");

		if (!isset($_COOKIE["key"]))
		{
			header("location: scripts/MovePage.php?MoveTo=Home");
			exit();
		}
	?>

	<div style="text-align: center">
		<div class="box-flex & box-style">
				<h1><?php echo $_POST["create"];?></h1>
				<b1>

				<form method="post" action="../scripts/Create.php">

				<?php
					
					include_once("scripts/connection.php");
					include_once("scripts/SubjectFunctions.php");
					include_once("scripts/TopicFunctions.php");
					//include_once("../scripts/DefinitionFunctions.php");

					//echo "<p>" . $_POST["TopicName"] . "</p>";
					//echo "<p>" . $_POST["SubjectName"] . "<p>";

					if ($_POST["From"] == "CreateOptions")
					{
						if ($_POST["create"] == "Create Topic")
						{
							echo '<div class="vertical-box-item" >Enter new Topic Name</div>';
							echo '<div class="vertical-box-item" ><input type="textbox" name="NewTopicName" placeholder="Topic Name" maxlength="45" required></div>';
							echo '<div class="vertical-box-item" ><textarea name="TopicDesc" minlength="15" maxlength="254" rows="20" cols="40" placeholder="Topic Description" required style="resize:vertical"></textarea></div>';
							echo '<div><input type="submit" class="header-button-style & button-change" name="create" value="Create Topic" ></div>';
							
						}


						
					}


				
				
				?>

				</form>
				</b1>

		</div>
	</div>
</body>
</html>