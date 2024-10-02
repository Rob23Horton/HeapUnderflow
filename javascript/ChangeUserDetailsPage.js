//Javascript file


function showPassword()
{
	var password = document.getElementById("password");

	if (password.type === "password")
	{
		password.type = "text";
		return;
	}
	password.type = "password";

}


function showNewPassword()
{
	var newPassword = document.getElementById("newPassword");
	var newPasswordRetype = document.getElementById("newPasswordRetype");

	if (newPassword.type === "password") {
		newPassword.type = "text";
		newPasswordRetype.type = "text";
		return;
	}
	newPassword.type = "password";
	newPasswordRetype.type = "password";
}


function checkPasswordValid()
{
	var password = document.getElementById("password");

	if (password.value.length < 8)
	{
		password.setCustomValidity("Password must be 8 characters or longer");
		return;
	}

	password.setCustomValidity("");
}


function checkUsernameValid()
{
	var username = document.getElementById("newUsername");

	if (username.value.length < 3)
	{
		username.setCustomValidity("Username must be 3 characters or longer");
		return;
	}

	username.setCustomValidity("");
}


function checkNewPasswordValid()
{
	var newPassword = document.getElementById("newPassword");
	var newPasswordRetype = document.getElementById("newPasswordRetype");

	if (newPassword.value.length < 8)
	{
		newPassword.setCustomValidity("New password must be 8 characters or longer");
		return;
	}
	newPassword.setCustomValidity("");

	if (newPassword.value != newPasswordRetype.value)
	{
		newPasswordRetype.setCustomValidity("Passwords don't match");
		return;
	}
	newPasswordRetype.setCustomValidity("");

}