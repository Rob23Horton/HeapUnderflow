<?php

include_once("../scripts/connection.php");

if (!isset($_COOKIE["key"]))
{
	header("location: ../scripts/MovePage.php?MoveTo=Home");
	exit();
}

include_once("../scripts/TopicFunctions.php");
include_once("../scripts/SubjectFunctions.php");
include_once("../scripts/DefinitionFunctions.php");
include_once("../scripts/KeyFunctions.php");

$topics = GetAllTopicNames($conn);


if ($_POST["create"] == "Create Topic")
{
	$newTopic = $_POST["NewTopicName"];
	$newDesc = $_POST["TopicDesc"];

	if (in_array($newTopic, $topics))
	{
		header("location: ../CreateOptionsPage.php?error=topicalreadyexists");
		exit();
	}

	CreateTopic($conn, $newTopic, $newDesc);

}
else if ($_POST["create"] == "Create Subject")
{
	$topicName = $_POST["TopicName"];
	$subjectName = $_POST["NewSubjectName"];

	$topicCode = GetTopicIdFromName($conn, $topicName);

	if (is_null($topicCode)){
		header("location: ../scripts/MovePage.php?MoveTo=Home");
		exit();
	}

	CreateSubject($conn, $subjectName, $topicCode);

}
else if ($_POST["create"] == "Create Definition")
{

	$topic = $_POST["TopicName"];
	$subject = $_POST["SubjectName"];
	$defintion = $_POST["Definition"];

	$topicCode = GetTopicIdFromName($conn, $topic);

	$subjectCode = GetSubjectIdFromTopicCodeAndSubjectName($conn, $topicCode, $subject);

	if (is_null($subjectCode))
	{
		header("location: ../scripts/MovePage.php?MoveTo=Home");
		exit();
	}

	$userCode = GetUserIdFromKey($conn, $_COOKIE["key"]);

	CreateDefinition($conn, $defintion, $userCode, $subjectCode);
}

header("location: ../scripts/MovePage.php?MoveTo=Home");
exit();

?>