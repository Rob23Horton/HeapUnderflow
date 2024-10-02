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
			<form method="post" action="SubjectPage.php">
				<?php

					include_once("scripts/connection.php");
					include_once("scripts/TopicFunctions.php");
					include_once("scripts/SubjectFunctions.php");
			
					$topic_name = $_POST["topic"];

					$topic_id = GetTopicIdFromName($conn, $topic_name);

					$topic_desc = GetTopicDesc($conn, $topic_id);

					$topic_subjects = GetSubjectsFromTopicId($conn, $topic_id);

					echo '<h1>'.$topic_name.'</h1>';
					echo '<input type="text" name="topic" value="'.$topic_name.'" hidden>';//Used to pass topic to next page

					echo "<h2>Topic Description - </h2>";
					echo '<b1><textarea readonly rows="5" cols="40" style="padding-bottom:5%;resize:vertical">'.$topic_desc.'</textarea></b1>';
				
					echo "<b2><h3>Search Subjects</h3><div class='vertical-box-item'>";
			
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

			<h3>
			<form method="post" action="../CreatePage.php">
				<p>Create Subject</p>
				<?php
					echo "<input name='From' value='TopicPage' hidden>";
					echo "<input name='TopicName' value='" . $_POST["topic"] . "' hidden>";
					echo "<input name='SubjectName' id='SubjectName' value='' hidden>"
				?>
				<p><input type='submit' class='header-button-style & button-update' name="create" value='Create Subject'></p>
			</form>
			</h3>
		</div>
	</div>
</body>

</html>