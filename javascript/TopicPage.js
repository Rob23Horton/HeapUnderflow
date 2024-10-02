// JavaScript Document



function updateSubjectList()
{
	var searchInput = document.getElementById("subjectSearch");
	var subjectFilter = searchInput.value.toUpperCase();
	var subjects = document.getElementById("subjects");
	var subjectItems = subjects.getElementsByTagName("li");
	
	for (var i = 0; i < subjectItems.length; i++)
	{
		var a = subjectItems[i].getElementsByTagName("a")[0];
		
		if (a.innerHTML.toUpperCase().indexOf(subjectFilter) > -1)
		{
			subjectItems[i].style.visibility = "visible";
		}
		else
		{
			subjectItems[i].style.visibility = "hidden";
		}
	}
}