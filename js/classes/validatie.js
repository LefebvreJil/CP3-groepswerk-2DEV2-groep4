module.exports = (function(){

	function validatie(){
        console.log("[validatie]");
		registratieValidatie();
	}

	function registratieValidatie (){
		console.log("[Registratie validatie]");
		//foto toevoegen
		var imageInput = document.querySelector("input[name=image]");
            var errorElement = imageInput.parentNode.querySelector(".error-message");
            imageInput.addEventListener("change", function(e){
                errorElement.style.display="none";
                var img=imageInput.parentNode.querySelector("img");
                if(img){ imageInput.parentNode.removeChild(img);}
                if(imageInput.files.length>0){
                    var file = imageInput.files['0'];
                    var error = "";
                    if(file.type.search("image") !==0){
                            errorElement.innerText = "the selected file is not an image";
                            errorElement.style.display = "block";
                    }else{
                        var reader = new FileReader();
                        reader.onload = function(e){
                            var img = document.createElement("img");
                            img.onload=function(e){imageInput.parentNode.appendChild(img);};
                            img.setAttribute("src", reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });


		//Fancy validatie
		
	}

	return validatie;
})();