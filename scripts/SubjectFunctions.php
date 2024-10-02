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

function GetAvailableSubjectsFromTopicCodeAndUserCode($conn, $topic_code, $user_code)
{
    $sql = "SELECT * FROM heapunderflow.tblSubjects as s WHERE s.topic_code = '$topic_code' AND s.subject_id NOT IN (SELECT d.subject_code FROM heapunderflow.tblDefinitions as d WHERE d.user_code = '$user_code');";

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
	$subject_name = mysqli_escape_string($conn, $subject_name);

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
	$subject_name = mysqli_escape_string($conn, $subject_name);

	$sql = 'INSERT INTO tblSubjects (subject_name, topic_code) VALUES("' . $subject_name . '", ' . $topic_code . ')';

	echo $sql;

	mysqli_query($conn, $sql);
}

function SubjectNamesAndTopicCodeFromLikeSubjectName($conn, $text)
{
    $text = mysqli_escape_string($conn, $text);


    $sql = "SELECT topic_code, subject_name FROM tblSubjects WHERE subject_name LIKE '%$text%';";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0)
	{
		return [];
	}

    $returnSubjects = [];

    while ($row = mysqli_fetch_assoc($result))
	{
		array_push($returnSubjects, str_pad($row['topic_code'], 4, '0', STR_PAD_LEFT) . $row['subject_name']);
	}

    return $returnSubjects;
}

function SubjectNamesAndTopicCodeFromLikeDefinitionName($conn, $text)
{
    $text = mysqli_escape_string($conn, $text);

    $sql = "SELECT s.topic_code, s.subject_name FROM tblSubjects as s INNER JOIN tblDefinitions as d ON d.subject_code = s.subject_id WHERE d.definition LIKE '%$text%';";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0)
	{
		return [];
	}

    $returnDefintions = [];

    while ($row = mysqli_fetch_assoc($result))
	{
		array_push($returnDefintions, str_pad($row['topic_code'], 4, '0', STR_PAD_LEFT) . $row['subject_name']);
	}

    return $returnDefintions;
}

?>