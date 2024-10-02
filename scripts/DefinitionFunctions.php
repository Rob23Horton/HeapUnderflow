<?php


function GetAllDefinitionsFromSubjectCode($conn, $subject_code)
{
	$sql = "SELECT definition FROM tblDefinitions WHERE subject_code = '$subject_code';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return [];
	}

	$definitions = [];

	while ($definition = mysqli_fetch_assoc($result)["definition"])
	{
		array_push($definitions, $definition);
	}

	return $definitions;
}

function GetDefinitionFromSubjectCodeAndUserCode($conn, $subject_code, $user_code)
{
	$sql = "SELECT definition FROM tblDefinitions WHERE subject_code = '$subject_code' AND user_code = '$user_code';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return;
	}
	
	$definition = mysqli_fetch_assoc($result)["definition"];

	return $definition;
}

function CreateDefinition($conn, $definition, $user_code, $subject_code)
{

	$definition = str_replace("'", "''", $definition);

	$sql = "INSERT INTO tblDefinitions (definition, user_code, subject_code) VALUES('$definition', '$user_code', $subject_code)";

	mysqli_query($conn, $sql);
}

?>