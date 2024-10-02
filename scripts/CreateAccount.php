
<?php

include_once("connection.php");
include_once("UserFunctions.php");


$username = $_POST["username"];
$password = $_POST["password"];
$hashedPassword = HashPassword($username, $password);

echo "<br>Checking user doesn't exist.";

if (UserExists($conn, $username))
{
	header("location: ../CreateAccountPage.php?error=useralreadyexists");
	exit();
}

echo "<br>User doesn't exist.";
echo "<br>Creating User.";

CreateUser($conn, $username, $hashedPassword);

echo "<br>Created User.";

header("location: ../LogInPage.php");
exit();

?>