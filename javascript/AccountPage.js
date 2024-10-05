// JavaScript Document



window.onload = (function (){
    var xhr = new XMLHttpRequest();

    var currentLocation = window.location.href.split("/Pages")[0];
    var image_id = document.getElementById("image_id").innerHTML;

    xhr.open('GET', currentLocation + '/WebService/Image/GetImage.php?image_id=' + image_id);

    xhr.onload = function(){
        if (xhr.status === 200){
            var data = JSON.parse(xhr.responseText);

            var image = document.getElementById("imagePreview");
            image.src = data["image_data"];
        }
        else
        {

            //TODO - Show debugging on web page
            console.log("Account Image couldn't be loaded")
            var errorLbl = document.getElementById("image_id");

            errorLbl.innerHTML = "Profile Image couldn't be loaded!";
            errorLbl.hidden = false;
        }
    }

    xhr.send();
});