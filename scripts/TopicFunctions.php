<?php


function GetAllTopicNames($conn)
{
	$sql = "SELECT topic_name FROM tblTopics ORDER BY topic_name;";

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

function GetTopicIdFromName($conn, $topic_name)
{
	$sql = "SELECT * FROM tblTopics WHERE topic_name = '$topic_name';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return;
	}

	$topic_id = mysqli_fetch_assoc($result)["topic_id"];

	return $topic_id;
}

function GetTopicDesc($conn, $topic_id)
{
	$sql = "SELECT * FROM tblTopics WHERE topic_id = '$topic_id';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return '';
	}

	$topic_desc = mysqli_fetch_assoc($result)["topic_desc"];

	return $topic_desc;
}

function CreateTopic($conn, $topicName, $topicDesc)
{
	$topicName = str_replace("'", "''", $topicName);

	$sql = "INSERT INTO tblTopics (topic_name, topic_desc) VALUES('$topicName', '$topicDesc');";

	mysqli_query($conn, $sql);
}

?>