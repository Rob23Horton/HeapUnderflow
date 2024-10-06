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

function GetAllDefinitionDataFromSubjectCode($conn, $subject_code)
{

	$sql = "SELECT d.definition_id, d.definition, u.user_id, u.username FROM tblDefinitions as d INNER JOIN tblUsers as u ON d.user_code = u.user_id WHERE d.subject_code = '$subject_code';";

	$result = mysqli_query($conn, $sql);

	return $result;

}

function GetImageCodesForDefinition($conn, $definition_id)
{
	$sql = "SELECT f.file_code FROM tblDefinitionFiles as f WHERE f.file_type = 'i' AND f.definition_code = '$definition_id';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return [];
	}

	$image_ids = [];

	while ($image = mysqli_fetch_assoc($result)["file_code"])
    {
        array_push($image_ids, $image);
    }

	return $image_ids;
}

function GetImagesForDefinition($conn, $definition_id)
{
    $sql = "SELECT i.image_id, i.image_data FROM tblDefinitionFiles as f INNER JOIN tblImages as i ON f.file_code = i.image_id WHERE f.file_type = 'i' AND f.definition_code = '$definition_id';";

    $result = mysqli_query($conn, $sql);

    return $result;

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

function GetDefinitionIdFromSubjectCodeAndUserCode($conn, $subject_code, $user_code)
{
	$sql = "SELECT definition_id FROM tblDefinitions WHERE subject_code = '$subject_code' AND user_code = '$user_code';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
	{
		return;
	}
	
	$definition = mysqli_fetch_assoc($result)["definition_id"];

	return $definition;
}

function CreateDefinition($conn, $definition, $user_code, $subject_code)
{
    $definition = mysqli_escape_string($conn, $definition);

	$sql = "INSERT INTO tblDefinitions (definition, user_code, subject_code) VALUES('$definition', '$user_code', $subject_code)";

	mysqli_query($conn, $sql);
}

function UpdateDefinition($conn, $definition, $user_code, $subject_code)
{
	$definition = mysqli_escape_string($conn, $definition);

	$sql = "UPDATE tblDefinitions SET definition = '$definition' WHERE user_code = '$user_code' AND subject_code = '$subject_code';";

	mysqli_query($conn, $sql);
	
}

function DeleteBlankDefinition($conn, $subject_code, $user_code)
{
    $definition = GetDefinitionFromSubjectCodeAndUserCode($conn, $subject_code, $user_code);


    if (trim($definition) == "")
    {
        #Delete the defintion
        $sql = "DELETE FROM heapunderflow.tblDefinitions WHERE subject_code = '$subject_code' AND user_code = '$user_code';";

        mysqli_query($conn, $sql);

    }

}

function DefinitionNamesFromLikeDefinitionName($conn, $text)
{
    $text = mysqli_escape_string($conn, $text);


    $sql = "SELECT definition FROM tblDefinitions WHERE definition LIKE '%$text%';";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0)
	{
		return [];
	}

    $returnDefintions = [];

    while ($row = mysqli_fetch_assoc($result))
	{
		array_push($returnDefintions, $row['definition']);
	}

    return $returnDefintions;
}

function CreateDefinitionFile($conn, $definition_code, $file_type, $file_code)
{
	$sql = "INSERT INTO tblDefinitionFiles (definition_code, file_type, file_code) VALUES ($definition_code, '$file_type', $file_code);";

	mysqli_query($conn, $sql);
}

function GetImagesForDefinitionFromIdAndUserCode($conn, $definition_id, $user_code)
{
	$sql = "SELECT d.definition_id, i.image_id, i.image_data FROM tblDefinitions as d INNER JOIN tblDefinitionFiles as f ON d.definition_id = f.definition_code INNER JOIN tblImages as i ON f.file_code = i.image_id WHERE f.file_type = 'i' AND f.definition_code = '$definition_id' AND d.user_code = '$user_code';";

	$result = mysqli_query($conn, $sql);

	return $result;
}

function GetAllImageCodesForDefinitions($conn)
{
    $sql = "SELECT file_code FROM tblDefinitionFiles WHERE file_type = 'i';";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0)
    {
        return [];
    }

    $imageCodes = [];

    while ($image = mysqli_fetch_assoc($result)["file_code"])
    {
        array_push($imageCodes, $image);
    }

    return $imageCodes;
}

function DeleteDefinitionFileFromDefinitionIdAndImageCodeAndUserCode($conn, $definition_id, $image_code, $user_code)
{
	$sql = "SELECT f.definition_file_id FROM tblDefinitionFiles as f INNER JOIN tblDefinitions as d ON d.definition_id = f.definition_code WHERE f.file_type = 'i' AND f.file_code = '$image_code' AND d.user_code = '$user_code' AND d.definition_id = '$definition_id';";

	$result = mysqli_query($conn, $sql);

    while ($definition_file_id = mysqli_fetch_assoc($result)["definition_file_id"])
    {
        $sql = "DELETE FROM tblDefinitionFiles WHERE definition_file_id = '$definition_file_id'";

        echo $sql;

        mysqli_query($conn, $sql);
    }
}

?>