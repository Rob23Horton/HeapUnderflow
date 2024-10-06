<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Heap Underflow</title>

	<link href="../style/style.css" rel="stylesheet" type="text/css">

	<script src="../javascript/SubjectPage.js"></script>
    <script src="../javascript/UploadImage.js"></script>

</head>

<body onload="LoadDefinitionImages()">
	<?php
		include("../scripts/header.php");
	?>

	<div style="text-align: center">
		<div class="box-flex & box-style">

			<?php
				include_once("../scripts/connection.php");
				include_once("../scripts/TopicFunctions.php");
				include_once("../scripts/SubjectFunctions.php");
				include_once("../scripts/DefinitionFunctions.php");
			
				$TopicName = $_GET["topic"];
				$SubjectName = $_GET["subject"];

				$TopicCode = GetTopicIdFromName($conn, $TopicName);

				$SubjectCode = GetSubjectIdFromTopicCodeAndSubjectName($conn, $TopicCode, $SubjectName);

				if (is_null($SubjectCode))
				{
					header("location: ../scripts/MovePage.php?MoveTo=Home");
					exit();
				}

				if (isset($_COOKIE["key"]))
				{
					$UserCode = GetUserIdFromKey($conn, $_COOKIE["key"]);
				}

				echo '<h1>'.$SubjectName.'</h1>';

				echo '<b1>';

				if (!is_null($UserCode)) //Make editable if there is a definition or show button to create a new definition (Move to CreatePage.php)
				{
                    DeleteBlankDefinition($conn, $SubjectCode, $UserCode);
					$UserDefinition = GetDefinitionFromSubjectCodeAndUserCode($conn, $SubjectCode, $UserCode);
					
					if (!is_null($UserDefinition))
					{
						echo '<form method="post" action="scripts/Create.php" class="vertical-box-item">';
						echo '<h2>Your Definition</h2>';
						echo '<input type="text" name="topicName" value="'.htmlspecialchars($TopicName).'" hidden>';
						echo '<input type="text" name="subjectName" value="'.htmlspecialchars($SubjectName).'" hidden>';
						echo '<div><textarea minlength="20" maxlength="65535" rows="3" cols="40" style="width:50%;padding-bottom:5%;resize:vertical" name="definition">'.$UserDefinition.'</textarea></div>';
						echo '<div><input type="submit" class="header-button-style & button-update" name="create" value="Update Definition"></div>';

						if ($_GET["updated"] == "true")
						{
							echo '<div><p>Updated!</p></div>';
						}
						else if ($_GET["updated"] == "false")
						{
							echo '<div><p>Something went wrong!</p></div>';
						}
						echo '</form>';
                        
                        echo '<div>';

                        include_once("../scripts/KeyFunctions.php");
                        include_once("../scripts/ImageFunctions.php");

                        $definitionId = GetDefinitionIdFromSubjectCodeAndUserCode($conn, $SubjectCode, $UserCode);

                        $userCode = GetUserIdFromKey($conn, $_COOKIE["key"]);

                        $allImageData = GetImagesForDefinitionFromIdAndUserCode($conn, $definitionId, $userCode);

                        while ($imageData = mysqli_fetch_assoc($allImageData))
                        {
                            $definition_id = $imageData["definition_id"];
                            $image = $imageData["image_data"];
                            $image_id = $imageData["image_id"];

                            echo '<form method="post" action="../scripts/DeleteImage.php" class="vertical-box-item">';
                            echo '<img src="'.$image.'" style="width:100%;height:auto;max-width:500px">'; //TODO - Change this
                            echo '<input type="text" name="definitionId" value="'.$definition_id.'" hidden>';
							echo '<input type="text" name="userCode" value="'.$userCode.'" hidden>';
							echo '<input type="text" name="imageId" value="'.$image_id.'" hidden>';
							echo '<input type="text" name="returnLocation" hidden>';
							echo '<div><input type="submit" class="header-button-style & button-update" value="Delete Image"></div>';
                            echo '</form>';

                        }

                        echo '<form method="post" action="../scripts/AddImage.php" class="vertical-box-item">';
                        echo '<input type="file" id="fileInput" oninput="ImageChanged()">';
                        echo '<input type="text" name="fileData" id="fileData" hidden>'; //Actual Data
                        echo '<input type="text" name="uploadType" value="Definition" hidden>'; //Image Type
                        echo '<input type="text" name="definitionCode" value="'.$definitionId.'" hidden>';
                        echo '<input type="text" name="returnLocation" id="returnLocation" hidden>'; //ReturnLocation
                            
                        if (isset($_GET["error"]))
                        {
                            if ($_GET["error"] == "FileTooLarge")
                            {
                                echo '<p>File Selected Was Too Large</p>';
                            }
                            else if ($_GET["error"] == "FileTooSmall")
                            {
                                echo '<p>No File Was Selected</p>';
                            }
                        }
                            
                        echo '<div><input type="submit" class="header-button-style & button-update" value="Upload Image"></div>';
                        echo '</form>';

					}
					else
					{
						echo '<form method="post" action="../Pages/CreatePage.php">';

						echo '<input type="text" name="topic" value="'.htmlspecialchars($TopicName).'" hidden>';
						echo '<input type="text" name="subject" value="'.htmlspecialchars($SubjectName).'" hidden>';
						echo '<input type="text" name="From" value="SubjectPage" hidden>';

						echo '<input class="header-button-style & button-update" type="submit" name="create" value="Create Definition">';

						echo '</form>';

					}
				}

				
				echo '<h2>Definitions</h2>';

				echo '<div class="vertical-box-item">';
				echo '<input type="text" id="definitionSearch" oninput="updateDefinitionList()" placeholder="Search for definition..." maxlength=510>';

				echo '<ul id="definitions">';

				$definitions = GetAllDefinitionDataFromSubjectCode($conn, $SubjectCode);

				while ($currDefinition = mysqli_fetch_assoc($definitions))
				{
                    $definitionId = $currDefinition["definition_id"];
					$username = $currDefinition["username"];
					$image = $currDefinition["image_data"];
					$define = $currDefinition["definition"];

					echo '<li class="vertical-box-item" style="text-align: center">';

                    echo '<table style="margin:auto">
                            <tr>
                                <td>
                                    <h4>'.htmlspecialchars($username).'</h4>
                                </td>
                                <td>
                                    <img src="'.$image.'" style="width:50px">
                                </td>
                            ';
					
					echo '<td><textarea readonly rows="3" cols="40" style="padding-bottom:5%;resize:vertical">'.htmlspecialchars($define).'</textarea></td></tr>
                        </table>';


					//This is definition images that is loaded by the JS
                    echo '<div name="definitionImageContainer">';
					echo '<label hidden>'.$definitionId.'</label>';
					echo '<div ><img src="" style="width:25%"/></div>';
					echo '</div>';

				}

				echo '</ul><p id="NoResults" style="display:none">Nothing to see.</p></div>';

			?>
			</b1>
		</div>
	</div>
</body>

</html>