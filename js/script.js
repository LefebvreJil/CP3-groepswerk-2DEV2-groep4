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
            var projectIndex = require('./classes/projectIndex.js');
            new projectIndex();

        //project toevoegen via ajax
            var dikkePlus = document.getElementById('dikkePlus');
            if(dikkePlus){
                var addProject = require('./classes/Addproject.js');
                dikkePlus.onclick = function(e){
                    event.preventDefault();
                    new addProject();
                };
            
            }
            
        //img class toevoegen
             var Img = require('./classes/img.js');
             var addImage = document.getElementById('imageSubmit');
             if(addImage){
                 addImage.onclick = function(event) {
                         if (window.File && window.FileReader && window.FileList && window.Blob){
                            new Img();
                        }
                 };
             }

         //video class toevoegen
            var video = require('./classes/video.js');
            var addVideo = document.getElementById('videoSubmit');
            if(addVideo){
                addVideo.onclick = function(event) {
                        if (window.File && window.FileReader && window.FileList && window.Blob){
                            new video();
                        }
                };
            }

        //alle functies op whiteboard tonen + stickynotes wijzigen + delete functie (?)
            var whiteboard = document.getElementById('whiteboard');
            if(whiteboard){
                var viewFunctions = require('./classes/Viewfunctions.js');
                new viewFunctions();
            }

        

        //stickyNote class toevoegen
            var stickyNote = require('./classes/stickyNote.js');
            var addStickyNote = document.getElementById('addStickyNote');
            if(addStickyNote){
                addStickyNote.onclick = function(event) {
                        event.preventDefault();
                        new stickyNote();
                };
            }

        //todo class toevoegen
            var Todo = require('./classes/todo.js');
            var addTodo = document.getElementById('addTodo');
            if(addTodo){
                addTodo.onclick = function(event) {
                        //event.preventDefault();
                        new Todo();
                };
            }

       
	}

    function moveWhiteboardOnClick(){
        $(document).ready(function(){
            $('.addBtn').click(function(){
                event.preventDefault();
                $('.whiteboard').toggleClass("moveWBoard");
                $('.addObjectUl').toggleClass("hide");

            });
        });
    }

	init();
    moveWhiteboardOnClick();
})();