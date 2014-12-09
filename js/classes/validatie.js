module.exports = (function(){
    var register_form;
    var login_form;

	function validatie(loginForm, registerForm){
        //console.log("[validatie]");
        if(loginForm!==0){
    		loginValidatie(loginForm);
        }
        if(registerForm!==0){
            
            registratieValidatie(registerForm);
        }
	}

    function loginValidatie(){
        console.log("[Login validatie]");
        login_form = this.loginForm;
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
                            img.setAttribute("width", "300");
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
        
        register_form = this.registerForm;

        var voornaamInput = register_form.querySelector('input[name=vn]');
        var achternaamInput = register_form.querySelector('input[name=an]');
        var nicknameInput = register_form.querySelector('input[name=nickname]');
        var emailInput = register_form.querySelector('input[name=email]');
        var passInput = register_form.querySelector('input[name=password]');
        var pass2Input = register_form.querySelector('input[name=repassword]');
        var qualitiesInput = register_form.querySelector('textarea');
        var jobInput = register_form.querySelector('input[name=job]');

        register_form.addEventListener('submit' , submitHandler);

        voornaamInput.addEventListener('blur', blurhandler);
        achternaamInput.addEventListener('blur', blurhandler);
        nicknameInput.addEventListener('blur', blurhandler);
        emailInput.addEventListener('blur', blurhandler);
        passInput.addEventListener('blur', blurhandler);
        pass2Input.addEventListener('blur', blurhandler);
        qualitiesInput.addEventListener('blur', blurhandler);
        jobInput.addEventListener('blur', blurhandler);

    }

    function blurhandler(event){
        validateNotEmpty(register_form,this);
    }

    function submitHandler(event){

        var allValid = true;

        allValid &=  validateNotEmpty(voornaamInput);
        allValid &=  validateNotEmpty(achternaamInput);
        allValid &=  validateNotEmpty(nicknameInput);
        allValid &=  validateNotEmpty(emailInput);
        allValid &=  validateNotEmpty(passInput);
        allValid &=  validateNotEmpty(pass2Input);
        allValid &=  validateNotEmpty(qualitiesInput);
        allValid &=  validateNotEmpty(jobInput);

        if (!allValid) {
            event.preventDefault();
        }

    }

    function validateNotEmpty(form,input){

        var errortag = form.querySelector('[data-for=' + input.getAttribute('name') + ']');
        if(input.value.length > 0){
            //valid
            errortag.classList.add('hidden');
            return true;
        }else{
            //not valid
            errortag.classList.remove('hidden');
            return false;
        }

    }




/*
        //login

        var loginform = document.getElementById('loginform');

        var emaillogInput = loginform.querySelector('input[name=email]');
        var passlogInput = loginform.querySelector('input[name=passwoord]');


        loginform.addEventListener('submit' , submitloginHandler);

        emaillogInput.addEventListener('blur', blurloginhandler);
        passlogInput.addEventListener('blur', blurloginhandler);


        function blurloginhandler(event){
            validateloginNotEmpty(this);
        }


        function submitloginHandler(event){

            var allValid = true;

            allValid &=  validateloginNotEmpty(passlogInput);
            allValid &=  validateloginNotEmpty(emaillogInput);

            if (!allValid) {
                event.preventDefault();
            };

        }

*/

	return validatie;
})();