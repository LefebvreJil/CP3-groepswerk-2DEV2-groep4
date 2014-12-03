(function(){
	
	function init() {
		users();
		
	}

	function users(){
		console.log("[Users.js] Hello Gilliepielietje");

		//submit knop selecteren
		$('#knopje').on('click', submit_clickHandler);
	}

	function submit_clickHandler (event){
		event.preventDefault();

		//data correct
		var inputData = {
			'vn': $('#registerVoornaam').val(),
			'an': $('#registerAchternaam').val(),
			'nickname': $('#registerNickname').val(),
			'kwaliteiten': $('#registerKwaliteiten').val(),
			'beroep': $('#registerBeroep').val(),
			'email': $('#registerEmail').val()
		};


			//foto toevoegen
			var imageInput = document.querySelector("input[name=image]");
                var errorElement = imageInput.parentNode.querySelector(".error-message");

                imageInput.addEventListener("change", function(e){
                        errorElement.style.display="none";
                        var img=imageInput.parentNode.querySelector("img");

                        if(img){
                            imageInput.parentNode.removeChild(img);
                        }

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
                                                img.onload=function(e){
                                                         imageInput.parentNode.appendChild(img);
                                                        
                                                };
                                                img.setAttribute("src", reader.result);
                                        };

                                        reader.readAsDataURL(file);
                                }
                        }
                });

		//BIJ INDIENEN URL NOG JUIST ZETTEN
		var saveUserAJAX = $.post('//localhost/CP3_groepswerk/index.php', inputData);

		//data die van controller komt denk ik
		//nog te testen
		/*
		saveUserAJAX.done(function(data){
			console.log('got data back' + data);
		});
		*/
	}

	function validateNotEmpty($el){
        var $errorMessage = $el.parent().find("span");

        if($el.val().length > 0){
                $el.removeClass("has-error");
                $errorMessage.addClass("hidden");
                return true;
        }

        $el.addClass("has-error");
        $errorMessage.removeClass("hidden");
        return false;
}

	init();
})();