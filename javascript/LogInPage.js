// JavaScript Document

function showPassword()
{
	var passwordInput = document.getElementById("password");
	if (passwordInput.type === "password")
	{
		passwordInput.type = "text";
	} else
	{
		passwordInput.type = "password";
	}
}


function checkEnteredValid()
{
	var username = document.getElementById("username");
	var password = document.getElementById("password");


	if (password.value.length < 8)
	{
		password.setCustomValidity("Password must be 8 characters or longer");
		return;
	}
	
	if (username.value.length < 3)
	{
		username.setCustomValidity("Username must be 3 characters or longer");
		return;
	}

	password.setCustomValidity("");
	username.setCustomValidity("");
}