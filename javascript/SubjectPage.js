// JavaScript Document


window.onload = function () {
	var definitionsList = document.getElementById("definitions");

	if (!definitionsList) {
		var noResultText = document.getElementById("NoResults");

		noResultText.style.display = "";
	}
}

function updateDefinitionList() {


	var searchInput = document.getElementById("definitionSearch");

	var definitionFilter = searchInput.value.toUpperCase();
	var definitions = document.getElementById("definitions");
	var definitionItems = definitions.getElementsByTagName("li");

	var noResultText = document.getElementById("NoResults");

	var amountShown = 0;

	for (var i = 0; i < definitionItems.length; i++) {
		var a = definitionItems[i].getElementsByTagName("textarea")[0];

		if (a.value.toUpperCase().indexOf(definitionFilter) > -1) {
			definitionItems[i].style.display = "";
			amountShown++;
		}
		else {
			definitionItems[i].style.display = "none";
		}
	}

	if (amountShown == 0) {

		noResultText.style.display = "";
	}
	else {
		noResultText.style.display = "none";
	}
}