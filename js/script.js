(function(){
	
	function init() {
		//console.log("[Script.js] Een goede en productieve dag gewenst aan Jil");

        //template selecteren
        var tpl = Handlebars.compile($('#project-template').html());
        var projectIndex = require('./classes/projectIndex.js');
        new projectIndex(tpl);

        var registerForm = document.getElementById('registerForm');
        var loginForm = document.getElementById('loginForm');
        var validatie = require('./classes/validatie.js');
        if(registerForm){
        	console.log("Register page");
        	loginForm = 0;
        	new validatie(loginForm, registerForm);
        }

        if(loginForm){
        	console.log("Login page");
        	registerForm = 0;
        	new validatie(loginForm, registerForm);
        }
		
	}

	init();
})();