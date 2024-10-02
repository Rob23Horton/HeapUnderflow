<h1>Topics</h1>
<b1>

	<form method="post" action="../TopicPage.php"> 

		<?php

			include("connection.php");
			include_once("TopicFunctions.php");

			$topics = GetAllTopicNames($conn);

			foreach ($topics as $topic)
			{
				echo '<p class="vertical-box-item"><input type="submit" class="header-button-style & button-update" name="topic" value="' . $topic . '" </p>';
			}

		?>

	</form>
</b1>