//Javascript file

function showPassword()
{
	var password = document.getElementById("password");
	var passwordRetype = document.getElementById("passwordRetype");

	if (password.type === "password") {
		password.type = "text";
		passwordRetype.type = "text";
	} else {
		password.type = "password";
		passwordRetype.type = "password";
	}
}

function checkEnteredValid()
{
	var username = document.getElementById("username");
	var password = document.getElementById("password");
	var passwordRetype = document.getElementById("passwordRetype");

	if (username.value.length < 3) {
		username.setCustomValidity("Username must be 3 characters or longer");
		return;
	}
	else if (username.value.length > 45)
	{
		username.setCustomValidity("Username must be 45 characters or less");
		return;
	}
	username.setCustomValidity("");

	if (password.value.length < 8)
	{
		password.setCustomValidity("Password must be 8 characters or longer");
		return;
	}
	password.setCustomValidity("");

	if (passwordRetype.value != password.value) {
		passwordRetype.setCustomValidity("Passwords don't match");
		return;
	}
	passwordRetype.setCustomValidity("");
}