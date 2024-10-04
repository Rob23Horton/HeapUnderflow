<?php

$postArray = $_POST;
$getArray = $_GET;

print_r(array_merge($_POST, $_GET));


foreach (array_merge($_POST, $_GET) as $key => $value)
{
	echo "Moving to $value";

	if ($value == "Home")
	{
		header("location: ../");
		exit();
	}
	
	else if ($value == "Log In")
	{
		header("location: ../Pages/LogInPage.php");
		exit();
	}
	
	else if ($value == "Log Out")
	{
		header("location: ../Pages/LogOutPage.php");
		exit();
	}

	else if ($value == "Create Account")
	{
		header("location: ../Pages/CreateAccountPage.php");
		exit();
	}

	else if ($value == "Account")
	{
		header("location: ../Pages/AccountPage.php");
		exit();
	}

	else if ($value == "Create")
	{
		header("location: ../Pages/CreateOptionsPage.php");
		exit();
	}
}

header("location: ../?error=somethingwentwrong");

?>