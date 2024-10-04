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



if ($_POST["create"] == "Create Topic")
{
    $topics = GetAllTopicNames($conn);

	$newTopic = $_POST["NewTopicName"];
	$newDesc = $_POST["TopicDesc"];

	if (in_array($newTopic, $topics))
	{
		header("location: ../Pages/CreateOptionsPage.php?error=topicalreadyexists");
		exit();
	}

	CreateTopic($conn, $newTopic, $newDesc);

    header("location: ../Pages/TopicPage.php?topic=".urlencode($newTopic));
    exit();
}
else if ($_POST["create"] == "Create Subject")
{
	$topicName = $_POST["TopicName"];
	$subjectName = $_POST["NewSubjectName"];

	$topicCode = GetTopicIdFromName($conn, $topicName);

	if (is_null($topicCode))
    {
		header("location: ../scripts/MovePage.php?MoveTo=Home");
		exit();
	}

    $subjects = GetSubjectsFromTopicId($conn, $topicCode);

    if (in_array($subjectName, $subjects))
    {
        header("location: ../Pages/CreateOptionsPage.php?error=subjectalreadyexists");
        exit();
    }

	CreateSubject($conn, $subjectName, $topicCode);

    header("location: ../Pages/SubjectPage.php?topic=".urlencode($topicName)."&subject=".urlencode($subjectName));
    exit();
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

    header("location: ../Pages/SubjectPage.php?topic=".urlencode($topic)."&subject=".urlencode($subject));
    exit();
}
else if ($_POST["create"] == "Update Definition")
{
	$topic = $_POST["topicName"];
	$subject = $_POST["subjectName"];

	$topicCode = GetTopicIdFromName($conn, $topic);

	$subjectCode = GetSubjectIdFromTopicCodeAndSubjectName($conn, $topicCode, $subject);

	if (is_null($subjectCode))
	{
		header("location: ../Pages/SubjectPage.php?topic=".urlencode($topic)."&subject=".urlencode($subject)."&updated=false");
		exit();
	}

	$userCode = GetUserIdFromKey($conn, $_COOKIE["key"]);

	UpdateDefinition($conn, $_POST["definition"], $userCode, $subjectCode);

	header("location: ../Pages/SubjectPage.php?topic=".urlencode($topic)."&subject=".urlencode($subject)."&updated=true");
	exit();

}

header("location: ../scripts/MovePage.php?MoveTo=Home");
exit();

?>