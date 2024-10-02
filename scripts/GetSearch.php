<?php

include_once("connection.php");
include_once("TopicFunctions.php");
include_once("SubjectFunctions.php");

$ReturnAddr = $_POST["ReturnAddress"];

if (!isset($_POST["SearchInput"]))
{
    header("location: ../scripts/MovePage.php?MoveTo=Home");
    exit();
}


$topics = TopicNameFromLikeTopicName($conn, $_POST["SearchInput"]);
$subjects = SubjectNamesAndTopicCodeFromLikeSubjectName($conn, $_POST["SearchInput"]);
$definitionssubject = [];
if (strlen($_POST["SearchInput"]) > 3)
{
    $definitionssubject = SubjectNamesAndTopicCodeFromLikeDefinitionName($conn, $_POST["SearchInput"]);
}


$counter = 0;

echo '<form id="returnSearch" method="post" action="'.$ReturnAddr.'">';

foreach ($topics as $topic)
{
    echo '<input type="hidden" name="SearchResult'.$counter.'" value="t'.str_replace('"', '""', $topic).'">';
    $counter += 1;
}

foreach ($subjects as $subject)
{
    echo '<input type="hidden" name="SearchResult'.$counter.'" value="s'.str_replace('"', '""', $subject).'">';
    $counter += 1;
}

foreach ($definitionssubject as $subject)
{
    if (!in_array($subject, $subjects))
    {
        echo '<input type="hidden" name="SearchResult'.$counter.'" value="s'.str_replace('"', '""', $subject).'">';
        $counter += 1;
    }
}

echo '<input type="hidden" name="SearchResultNum" value="'.$counter.'">';

echo '</form>';

echo '<script>document.forms["returnSearch"].submit();</script>';

?>
