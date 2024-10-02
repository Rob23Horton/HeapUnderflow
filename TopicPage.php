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
				include("scripts/TopicFunctions.php");
			
				$topic_name = $_POST["topic"];

				echo "<h1>$topic_name</h1>";

				$topic_id = GetTopicIdFromName($conn, $topic_name);

				$topic_desc = GetTopicDesc($conn, $topic_id);

				echo "<b1><p>Topic Description - </p>";
				echo "<p style='padding-bottom:5%'>$topic_desc</p></b1>";
				
			
			
			?>
			<b2 ><input type="text" id="subjectSearch" oninput="updateSubjectList()" placeholder="Search for subject..">
				
				<ul id="subjects" style="list-style-type: none">
				
					<li><a href="#">Test1</a></li>
					<li><a href="#">Charlie</a></li>
					<li><a href="#">Damian</a></li>
				
				
				</ul>
			
			
			
			
			</b2>
		</div>
	</div>
</body>

</html>