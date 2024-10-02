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

function GetSubjectIdFromTopicCodeAndSubjectName($conn, $topic_code, $subject_name)
{
	$sql = "SELECT subject_id FROM heapunderflow.tblSubjects as s INNER JOIN tblTopics as t ON t.topic_id = s.topic_code WHERE t.topic_id = '$topic_code' AND s.subject_name = '$subject_name';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return;
	}

	$subject_id = mysqli_fetch_assoc($result)["subject_id"];

	return $subject_id;

}

function GetAllSubjectNames($conn)
{
	$sql = "SELECT subject_name FROM tblSubjects;";

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

function CreateSubject($conn, $subject_name, $topic_code)
{
	$subject_name = str_replace("'", "''", $subject_name);

	$sql = 'INSERT INTO tblSubjects (subject_name, topic_code) VALUES("' . $subject_name . '", ' . $topic_code . ')';

	echo $sql;

	mysqli_query($conn, $sql);
}

?>