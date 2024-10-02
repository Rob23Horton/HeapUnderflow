// JavaScript Document

function updateAvailableSubjects()
{
	UpdateSecretSubjectName();

	var topic = document.getElementById("ParentTopic");

	var subjects = document.getElementsByTagName("ul");

	for (var i = 0; i < subjects.length; i++)
	{
		if (subjects[i].id == topic.value) {
			subjects[i].hidden = false;
		}
		else {
			subjects[i].hidden = true;
		}
	}
}

function UpdateSecretSubjectName()
{
	var secretTextBox = document.getElementById("hiddenSubjectName");

	var topic = document.getElementById("ParentTopic").value;
	var subjects = document.getElementsByTagName("ul");

	for (var i = 0; i < subjects.length; i++) {
		if (subjects[i].id == topic)
		{
			secretTextBox.value = subjects[i].getElementsByTagName("select")[0].value;
			break;
		}
	}
}