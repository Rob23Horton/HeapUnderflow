<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Heap Underflow</title>

	<link href="../style/style.css" rel="stylesheet" type="text/css">
    <script src="../javascript/DrawPage.js"></script>
</head>

<body>
    <?php
        //Be able to be a guest
        if (!isset($_COOKIE["key"]))
        {
            echo '<form method="post" action="../Pages/LogInPage.php" id="logInForm" hidden><input type="text" name="returnLocation" value="../Pages/DrawPage.php"></form><script>document.getElementById("logInForm").submit();</script>';
        }


        include_once("scripts/header.php");
    ?>

    <div>
        <canvas id="canvas" style="border: 1px solid black;">
            Your browser doesn't support the HTML 5 canvas

        </canvas>
    </div>
	
</html>