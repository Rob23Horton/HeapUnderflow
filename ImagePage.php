<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Heap Underflow</title>

	<link href="style/style.css" rel="stylesheet" type="text/css">

	<script src="javascript/SubjectPage.js"></script>
    <script src="javascript/UploadImage.js"></script>

</head>

<body>
	<?php
		include("scripts/header.php");
	?>

	<div style="text-align: center">
		<div class="box-flex & box-style">
            <form method="post" action="../scripts/DownloadImage.php">
                <?php

                    if (!isset($_GET["ImageId"]))
                    {
                        header("location: ../scripts/MovePage.php?MoveTo=Home");
                        exit();
                    }

                    $fileName = "image";

                    if (isset($_GET["FileName"]))
                    {
                        $fileName = $_GET["FileName"];
                    }
                    
                    include_once("scripts/connection.php");
                    include_once("scripts/ImageFunctions.php");

                    $imageId = $_GET["ImageId"];

                    $image = GetImageFromId($conn, $imageId);


                    echo '<input type="submit" class="header-button-style & button-update" value="Download Image">
                    <div><img src="'.$image.'" style="width:100%"></div>
                    <input type="text" name="imageId" value="'.$imageId.'" hidden>
                    <input type="text" name="fileName" value="'.$fileName.'" hidden>';

                ?>
            </form>
		</div>
	</div>
</body>

</html>