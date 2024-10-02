<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Heap Underflow</title>

	<link href="style/style.css" rel="stylesheet" type="text/css">

</head>

<body>
	<?php
		include_once("scripts/connection.php");

		include("scripts/header.php");
	?>

	<div style="text-align: center">
		<div class="box-flex & box-style">
            <table style="margin:auto">
                <tr>
                    <td style="padding-right:50px;vertical-align:top">
                        <?php

                            include("scripts/TopicsGridBody.php");
                        ?>
                    </td>
                    <td style="vertical-align:top">
                        <?php
                            include_once("scripts/SearchBar.php");
                        ?>
                    </td>
                </tr>
            </table>
		</div>
	</div>


</body>
</html>