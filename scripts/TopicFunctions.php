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
	$topic_name = str_replace("'", "''", $topic_name);
	$topic_name = str_replace('"', '\"', $topic_name);

	$sql = "SELECT topic_id FROM tblTopics WHERE topic_name = '$topic_name';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return;
	}

	$topic_id = mysqli_fetch_assoc($result)["topic_id"];

	return $topic_id;
}

function GetTopicNameFromId($conn, $topic_id)
{
    $sql = "SELECT topic_name FROM tblTopics WHERE topic_id = '$topic_id';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return;
	}

	$topic_id = mysqli_fetch_assoc($result)["topic_name"];

	return $topic_id;
}

function GetTopicDesc($conn, $topic_id)
{
	$sql = "SELECT topic_desc FROM tblTopics WHERE topic_id = '$topic_id';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return '';
	}

	$topic_desc = mysqli_fetch_assoc($result)["topic_desc"];

	return $topic_desc;
}

function CreateTopic($conn, $topic_name, $topicDesc)
{
	$topic_name = str_replace("'", "\'", $topic_name);
	$topic_name = str_replace('"', '\"', $topic_name);

	$topicDesc = str_replace("'", "\'", $topicDesc);
	$topicDesc = str_replace('"', '\"', $topicDesc);

	$sql = "INSERT INTO tblTopics (topic_name, topic_desc) VALUES('$topic_name', '$topicDesc');";
	
	mysqli_query($conn, $sql);
}

function TopicNameFromLikeTopicName($conn, $text)
{
    $text = str_replace("'", "\'", $text);
	$text = str_replace('"', '\"', $text);


    $sql = "SELECT topic_name FROM tblTopics WHERE topic_name LIKE '%$text%';";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0)
	{
		return [];
	}

    $returnTopic = [];

    while ($row = mysqli_fetch_assoc($result))
	{
		array_push($returnTopic, $row['topic_name']);
	}

    return $returnTopic;
}

?>