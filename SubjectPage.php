<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Heap Underflow</title>

	<link href="style/style.css" rel="stylesheet" type="text/css">
	
	<script src="javascript/TopicPage.js"></script>
	
</head>

<body>
	<?php
		include("scripts/header.php");
	?>

	<div style="text-align: center">
		<div class="box-flex & box-style">
			<?php
				include_once("scripts/connection.php");
				include_once("scripts/TopicFunctions.php");
				include_once("scripts/SubjectFunctions.php");
				include_once("scripts/DefinitionFunctions.php");
			
				$TopicName = $_POST["topic"];
				$SubjectName = $_POST["subject"];

				$TopicCode = GetTopicIdFromName($conn, $TopicName);

				$SubjectCode = GetSubjectIdFromTopicCodeAndSubjectName($conn, $TopicCode, $SubjectName);

				if (is_null($SubjectCode))
				{
					header("location: ../scripts/MovePage.php?MoveTo=Home");
					exit();
				}

				//Show user's definition first and make editable
				if (isset($_COOKIE["key"]))
				{
					$UserCode = GetUserIdFromKey($conn, $_COOKIE["key"]);
				}

				$definitions = GetAllDefinitionsFromSubjectCode($conn, $SubjectCode);

				echo '<h1>'.$SubjectName.'</h1>';

				echo '<b1>';

				if (!is_null($UserCode)) //Make editable if there is a definition or show button to create a new definition (Move to CreatePage.php)
				{
					$UserDefinition = GetDefinitionFromSubjectCodeAndUserCode($conn, $SubjectCode, $UserCode);

					echo "<p>Logged in as - $UserCode</p>";
					if (!is_null($UserDefinition))
					{
						echo "<p>$UserDefinition</p>";
					}
				}


				//TODO - Make list of all other definitions
				
				foreach ($definitions as $define)
				{
					echo "<p>Definition - $define</p>";
				}

				

				echo '</b1>';


			?>
		</div>
	</div>
</body>

</html>