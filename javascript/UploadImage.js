//JavaScript Document


function ImageChanged()
{

    var file = document.getElementById("fileInput").files[0];

    var extension = file.name.slice(-4);

    if (extension.toLowerCase() != ".jpg" && extension.toLowerCase() != "jpeg" && extension.toLowerCase() != ".png")
    {
        document.getElementById("fileInput").setCustomValidity("File Isn't valid Type");
    }
    else
    {
        document.getElementById("fileInput").setCustomValidity("");
    }

    var reader = new FileReader();

    reader.readAsDataURL(file);

    reader.onload = function()
    {

        var fileData = document.getElementById("fileData");
        var imagePreview = document.getElementById("imagePreview");

        fileData.value = reader.result;
        if (imagePreview != null)
        {
            imagePreview.src = fileData.value
        }
      };
    
      reader.onerror = function()
      {
        console.log(reader.error);

      };
}


//Make sure the component has an id for this to work correctly
window.onload = function GetCurrentHref(){
    var returnLocation = document.getElementById("returnLocation");
    if (returnLocation != null)
    {
        returnLocation.value = window.location.href;
    }
}