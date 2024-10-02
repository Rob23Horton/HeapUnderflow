<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Heap Underflow</title>

	<link href="style/style.css" rel="stylesheet" type="text/css">
	<script src="javascript/CreatePage.js"></script>
</head>

<body onload="updateAvailableSubjects()">
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

				<form method="post" action="../scripts/Create.php" Valid="UpdateSecretSubjectName()">

				<?php
					
					include_once("scripts/connection.php");
					include_once("scripts/SubjectFunctions.php");
					include_once("scripts/TopicFunctions.php");
                    include_once("scripts/KeyFunctions.php");

                    $user_code = GetUserIdFromKey($conn, $_COOKIE["key"]);

					
					if ($_POST["create"] == "Create Topic")
					{
						echo '<div class="vertical-box-item" >Enter New Topic Information</div>';
						echo '<div class="vertical-box-item" ><input type="textbox" name="NewTopicName" placeholder="Topic Name" maxlength="45" required></div>';
						echo '<div class="vertical-box-item" ><textarea name="TopicDesc" minlength="15" maxlength="254" rows="20" cols="40" placeholder="Topic Description" required style="resize:vertical"></textarea></div>';
						echo '<div><input type="submit" class="header-button-style & button-change" name="create" value="Create Topic" ></div>';
							
					}

					else if ($_POST["create"] == "Create Subject")
					{
                        

						$topics = GetAllTopicNames($conn);

						echo '<div class="vertical-box-item" >Enter New Subject Information</div>';

						
						echo '<div class="vertical-box-item" ><label>Parent Topic - </label><select name="TopicName">';

						foreach ($topics as $topic)
						{
							if ($_POST["From"] == "TopicPage" && $_POST["TopicName"] == $topic)
							{
								echo '<option value="'.htmlspecialchars($topic).'" selected>'.htmlspecialchars($topic).'</option>';
							}
							else
							{
								echo '<option value="'.htmlspecialchars($topic).'">'.htmlspecialchars($topic).'</option>';
							}
						}

						echo '</select></div>';

						if ($_POST["From"] == "TopicPage")
						{
							echo '<div class="vertical-box-item" ><input type="textbox" name="NewSubjectName" placeholder="Subject Name" maxlength="45" required value="' . htmlspecialchars($_POST["SubjectName"]) . '"></div>';
						}
						else
						{
							echo '<div class="vertical-box-item" ><input type="textbox" name="NewSubjectName" placeholder="Subject Name" maxlength="45" required></div>';
						}

						echo '<div><input type="submit" class="header-button-style & button-change" name="create" value="Create Subject" ></div>';
					}
					else if ($_POST["create"] == "Create Definition")
					{
						$topics = GetAllTopicNames($conn);
						
						echo '<div class="vertical-box-item" >Enter New Definition Information</div>';

						//Loop through all topics and get the subjects
						//JS can then show the ones that are suitable for the user for when they select a certain topic
						//Might not be the best for a large amount of subjects but should be fine due to only getting the name (There are a lot of loops for this to work)

						echo '<div class="vertical-box-item"><label>Parent Topic - </label><select name="TopicName" id="ParentTopic" onchange="updateAvailableSubjects()">';

						foreach ($topics as $topic)
						{
							echo $topic;
							if ($_POST["topic"] == $topic)
							{
								echo '<option value="'.htmlspecialchars($topic).'" selected>'.htmlspecialchars($topic).'</option>';
							}
							else
							{
								echo '<option value="'.htmlspecialchars($topic).'">'.htmlspecialchars($topic).'</option>';
							}
						}

						echo "</select></div>";


						foreach ($topics as $topic)
						{
							echo '<ul id="'.htmlspecialchars($topic).'" hidden>';

							$topicCode = GetTopicIdFromName($conn, $topic);

							$subjects = GetAvailableSubjectsFromTopicCodeAndUserCode($conn, $topicCode, $user_code);

							echo '<li class="vertical-box-item"><label>Parent Subject - </label><select onchange="UpdateSecretSubjectName()">';

							foreach ($subjects as $subject)
							{
								if ($_POST["subject"] == $subject)
								{
									echo '<option value="'.htmlspecialchars($subject).'" selected>'.htmlspecialchars($subject).'</option>';
								}
								else
								{
									echo '<option value="'.htmlspecialchars($subject).'">'.htmlspecialchars($subject).'</option>';
								}
							}

							echo "</select></li></ul>";
						}
						echo '<input type="text" name="SubjectName" id="hiddenSubjectName" hidden>';
						echo '<div class="vertical-box-item" ><textarea name="Definition" minlength="20" maxlength="65535" rows="20" cols="40" placeholder="Defintion" required style="resize:vertical"></textarea></div>';
						echo '<div><input type="submit" class="header-button-style & button-change" name="create" value="Create Definition" onclick="UpdateSecretSubjectName()"></div>';
					}
				
				?>

				</form>
				</b1>

		</div>
	</div>
</body>
</html>