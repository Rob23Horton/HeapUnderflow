<?php


function GetAllTopics($conn)
{
	$sql = "SELECT * FROM tblTopics;";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return;
	}

	$topicList = [];

	while ($row = mysqli_fetch_assoc($result))
	{
		array_push($topicList, $row['topic_name']);
	}

	return $topicList;
}


?>