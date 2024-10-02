<?php

function GetSubjectsFromTopicId($conn, $topic_id)
{
	$sql = "SELECT * FROM tblSubjects WHERE `topic_code` = '$topic_id';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return [];
	}

	$subjectNames = [];

	while ($subjectName = mysqli_fetch_assoc($result)["subject_name"])
	{
		array_push($subjectNames, $subjectName);
	}
	
	return $subjectNames;
}



?>