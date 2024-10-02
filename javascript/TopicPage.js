// JavaScript Document

window.onload = function()
{
	var subjectsList = document.getElementById("subjects");

	if (!subjectsList)
	{
		var noResultText = document.getElementById("NoResults");

		noResultText.style.display = "";
	}
}

function updateSubjectList()
{
	

	var searchInput = document.getElementById("subjectSearch");
	var newSubjectName = document.getElementById("SubjectName");
	newSubjectName.value = searchInput.value;

	var subjectFilter = searchInput.value.toUpperCase();
	var subjects = document.getElementById("subjects");
	var subjectItems = subjects.getElementsByTagName("li");

	var noResultText = document.getElementById("NoResults");

	var amountShown = 0;
	
	for (var i = 0; i < subjectItems.length; i++)
	{
		var a = subjectItems[i].getElementsByTagName("input")[0];
		
		if (a.value.toUpperCase().indexOf(subjectFilter) > -1)
		{
			subjectItems[i].style.display = "";
			amountShown++;
		}
		else
		{
			subjectItems[i].style.display = "none";
		}
	}

	if (amountShown == 0) {
		
		noResultText.style.display = "";
	}
	else
	{
		noResultText.style.display = "none";
	}
}