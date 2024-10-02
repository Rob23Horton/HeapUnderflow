<h1>Topics</h1>
<b1>

	<form method="post" action="../scripts/MovePage.php?MoveTo=Account"> 

		<?php

			//TODO - Make page to be able to show info about topic (Add description to topic table)

			include("connection.php");
			include_once("TopicFunctions.php");

			$topics = GetAllTopics($conn);

			foreach ($topics as $topic)
			{
				echo '<p><input type="submit" class="header-button-style & button-update" name="topic" value="' . $topic . '" </p>';
			}

		?>

	</form>
</b1>