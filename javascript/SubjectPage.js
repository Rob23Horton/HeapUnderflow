// JavaScript Document


function NoResultCheck()
{
	var definitionsList = document.getElementById("definitions");

	if (definitionsList.children.length == 0) {
		var noResultText = document.getElementById("NoResults");

		noResultText.style.display = "";
	}

	var returnLocations = document.getElementsByName("returnLocation");

	for (let i = 0; i < returnLocations.length; ++i)
	{
		returnLocations[i].value = window.location.href;
	}

}

function LoadDefinitionImages()
{
	NoResultCheck();
	LoadUserImages();

	var definitionImages = document.getElementsByName("definitionImageContainer");

	for (let index = 0; index < definitionImages.length; ++index)
	{
		var definitionId = (definitionImages[index]).getElementsByTagName("label")[0].innerHTML;

		var imageDiv = (definitionImages[index]).getElementsByTagName("div")[0];
		
		GetDefinitonImageIds(definitionId, imageDiv);
	}
}


function GetDefinitonImageIds(definitionId, imageDiv)
{
	var currentLocation = window.location.href.split("/Pages")[0];

	var xhr = new XMLHttpRequest();

    xhr.open('GET', currentLocation+'/WebService/Definition/GetDefinitionImages.php?definition_id='+definitionId);

    xhr.onload = function(){
        if (xhr.status === 200){
            var data = JSON.parse(xhr.responseText);

            var image_ids = data["image_ids"];

			image_ids.forEach(function(currImage){
				GetAndCreateImage(currImage, imageDiv, window.innerWidth / 6, "");

			});
        }
        else
        {
            console.log("Definition images couldn't be loaded")
        }
    }

    xhr.send();
}

function GetAndCreateImage(imageId, imageDiv, width, style)
{
	var currentLocation = window.location.href.split("/Pages")[0];

	var xhr = new XMLHttpRequest();

    xhr.open('GET', currentLocation+'/WebService/Image/GetImage.php?image_id='+imageId);

    xhr.onload = function(){
        if (xhr.status === 200){
            var data = JSON.parse(xhr.responseText);

            var image_data = data["image_data"];

			//Creates image
			var img = document.createElement('img');
			img.src = image_data;
			img.setAttribute("width", width);
			img.setAttribute("style", style+";cursor:pointer");
			img.setAttribute("onclick", "GoToPage('"+currentLocation+"/Pages/ImagePage.php?ImageId="+imageId+"&FileName=HeapUnderflowImage')");
			imageDiv.appendChild(img);
        }
        else
        {
			var errorLbl = document.createElement('label');
			errorLbl.innerHTML = "Image couldn't be loaded";
			imageDiv.appendChild(errorLbl);
        }
    }

    xhr.send();

}


async function LoadUserImages()
{

	var imageContainers = document.getElementsByName("userDefinitionContainer");

	for (let index = 0; index < imageContainers.length; ++index)
	{
		var userId = (imageContainers[index]).getElementsByTagName("label")[0].innerHTML;

		var imageDiv = (imageContainers[index]).getElementsByTagName("div")[0];

		console.log(imageDiv);

		GetUserImages(userId, imageDiv);
	}

}


function GetUserImages(userId, containerDiv)
{

	var currentLocation = window.location.href.split("/Pages")[0];

	var xhr = new XMLHttpRequest();

    xhr.open('GET', currentLocation+'/WebService/User/GetUserImage.php?user_id='+userId);

    xhr.onload = function(){
        if (xhr.status === 200){
            var data = JSON.parse(xhr.responseText);

            var image_id = data["image_id"];

			GetAndCreateImage(image_id, containerDiv, window.innerWidth / 14, "border:2px solid black;border-radius:250px");
        }
        else
        {
            console.log("User image couldn't be loaded")
        }
    }

    xhr.send();

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


function GoToPage(url){
	window.open(url, "_blank");
}