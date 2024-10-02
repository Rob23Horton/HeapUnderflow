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
			
				$topic_name = $_POST["topic"];

				$topic_id = GetTopicIdFromName($conn, $topic_name);

				$topic_desc = GetTopicDesc($conn, $topic_id);

				$topic_subjects = GetSubjectsFromTopicId($conn, $topic_id);

				echo "<h1>$topic_name</h1>";

				echo "<b1><p>Topic Description - </p>";
				echo '<textarea readonly rows="5" cols="40" style="padding-bottom:5%;resize:vertical">'.$topic_desc.'</textarea></b1>';
				
				echo "<b2><form method='post' action='../'>";
				

			
				if (sizeof($topic_subjects) > 0)
				{
					echo "<input type='text' id='subjectSearch' oninput='updateSubjectList()' placeholder='Search for subject...' name='AddSubject' maxlength=45>";
					echo "<ul id='subjects'>";
					foreach ($topic_subjects as $subject)
					{
						echo "<li class='vertical-box-item'><input type='submit' class='header-button-style & button-update' name='subject' value='$subject'</li>";
					}

					echo "</ul>";
				}

			?>

			<p id='NoResults' style='display:none'>Nothing to see.</p>
			</form>
			</b2>

			<h2>
			<form method="post" action="../CreatePage.php">
				<p>Create Subject</p>
				<?php
					echo "<input name='From' value='TopicPage' hidden>";
					echo "<input name='TopicName' value='" . $_POST["topic"] . "' hidden>";
					echo "<input name='SubjectName' id='SubjectName' value='' hidden>"
				?>
				<p><input type='submit' class='header-button-style & button-update' name="type" value='Create New Subject'></p>
			</form>
			</h2>
		</div>
	</div>
</body>

</html>