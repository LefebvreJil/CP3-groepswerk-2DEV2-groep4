(function(){
	
	function init() {
		//console.log("[Script.js] Een goede en productieve dag gewenst aan Jil");


        //Registreren en inloggen
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

        //template
            var tpl = Handlebars.compile($('#project-template').html());
            var projectIndex = require('./classes/projectIndex.js');
            new projectIndex(tpl);

        //project toevoegen via ajax
            var dikkePlus = document.getElementById('dikkePlus');
            console.log(dikkePlus);
            var addProject = require('./classes/Addproject.js');
            dikkePlus.onclick = function(e){
                event.preventDefault();
                new addProject();
            };
            


        //img class toevoegen
            var Img = require('./classes/img.js');
            document.getElementById('addImage').onclick = function(event) {
                    event.preventDefault();
                    console.log("click");
                    new Img();
            };

        //video class toevoegen
            var video = require('./classes/video.js');
            document.getElementById('addVideo').onclick = function(event) {
                    event.preventDefault();
                    console.log("click");
                    new video();
            };

        //stickyNote class toevoegen
            var stickyNote = require('./classes/stickyNote.js');
            document.getElementById('addStickyNote').onclick = function(event) {
                    event.preventDefault();
                    console.log("click");
                    new stickyNote();
            };

        //todo class toevoegen
            var Todo = require('./classes/todo.js');
            document.getElementById('addTodo').onclick = function(event) {
                    event.preventDefault();
                    console.log("click");
                    new Todo();
            };

        //draw class toevoegen
            var Draw = require('./classes/draw.js');
            document.getElementById('draw').onclick = function(event) {
                    event.preventDefault();
                    console.log("click");
                    new Draw();
            };

	}

    function moveWhiteboardOnClick(){
        $(document).ready(function(){
            $('.addBtn').click(function(){
                    event.preventDefault();
                    $('.whiteboard').toggleClass("moveWBoard");
                    console.log('move');
                });
            });
    }
    
	init();
    moveWhiteboardOnClick();
})();