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
		header("location: ../LogInPage.php");
		exit();
	}
	
	else if ($value == "Log Out")
	{
		header("location: ../LogOutPage.php");
		exit();
	}

	else if ($value == "Create Account")
	{
		header("location: ../CreateAccountPage.php");
		exit();
	}

	else if ($value == "Account")
	{
		header("location: ../AccountPage.php");
		exit();
	}

	else if ($value == "Create")
	{
		header("location: ../CreateOptionsPage.php");
		exit();
	}
}

header("location: ../?error=somethingwentwrong");

?>