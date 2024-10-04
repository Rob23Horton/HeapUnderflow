
<?php

include_once("connection.php");
include_once("UserFunctions.php");
include_once("UserInfoFunctions.php");


$username = $_POST["username"];
$password = $_POST["password"];
$hashedPassword = HashPassword($username, $password);

if (UserExists($conn, $username))
{
	header("location: ../Pages/CreateAccountPage.php?error=useralreadyexists");
	exit();

}

CreateUser($conn, $username, $hashedPassword);

//Gets user Id and creates new user information to be able to add extra information
$userId = GetUserId($conn, $username, $hashedPassword);
CreateNewUserInfo($conn, $userId);

header("location: ../Pages/LogInPage.php");
exit();

?>