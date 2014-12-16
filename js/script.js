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
            

        //alles van project
            var dikkePlus = document.getElementById('dikkePlus');
            if(dikkePlus){

                //project toevoegen
                var addProject = require('./classes/Addproject.js');
                dikkePlus.onclick = function(e){
                    event.preventDefault();
                    new addProject();
                };

                //projecten tonen
                var projectIndex = require('./classes/projectIndex.js');
                new projectIndex();
            }
            
        

        //alles van whiteboard
            var whiteboard = document.getElementById('whiteboard');
            if(whiteboard){

                //elementen erop laten tonen
                var viewFunctions = require('./classes/Viewfunctions.js');
                new viewFunctions();


                //img class toevoegen
                 var Img = require('./classes/img.js');
                 new Img();

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