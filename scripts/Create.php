<?php


include_once("../scripts/connection.php");

if (!isset($_COOKIE["key"]))
{
	header("location: ../scripts/MovePage.php?MoveTo=Home");
	exit();
}

include_once("../scripts/TopicFunctions.php");

$topics = GetAllTopicNames($conn);

if ($_POST["create"])
{
	$newTopic = $_POST["NewTopicName"];
	$newDesc = $_POST["TopicDesc"];

	echo $newTopic;
	echo $newDesc;

	if (in_array($newTopic, $topics))
	{
		header("location: ../CreateOptionsPage.php?error=topicalreadyexists");
		exit();
	}

	CreateTopic($conn, $newTopic, $newDesc);
}












?>