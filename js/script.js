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
            var addImage = document.getElementById('addImage');
            if(addImage){
                addImage.onclick = function(event) {
                        event.preventDefault();
                        chooseImage();

                        //Grote fout.
                        // if (window.File && window.FileReader && window.FileList && window.Blob){
                        // //foto toevoegen
                        // var imageWboard = document.querySelector("input[name=imageWboard]");
                        //     imageWboard.addEventListener("change", function(e){
                        //         var imgBoard=imageWboard.parentNode.querySelector("imgBoard");
                        //         if(imgBoard){ imageWboard.parentNode.removeChild(imgBoard);}
                        //         if(imageWboard.files.length>0){
                        //             var file = imageWboard.files['0'];
                        //             if(file.type.search("image") !==0){
                        //                     // errorElement.innerText = "the selected file is not an image";
                        //                     // errorElement.style.display = "block";
                        //             }else{
                        //                 var reader = new FileReader();
                        //                 reader.onload = function(e){
                        //                     var imgBoard = document.createElement("imgBoard");
                        //                     imgBoard.onload=function(e){imageWboard.parentNode.appendChild(imgBoard);};
                        //                     imgBoard.setAttribute("src", reader.result);
                        //                     imgBoard.setAttribute("width", "300");
                        //                 };
                        //                 reader.readAsDataURL(file);
                        //             }
                        //         }
                        //     });
                        // }
                        new Img();
                };
            }

        //video class toevoegen
            var video = require('./classes/video.js');
            var addVideo = document.getElementById('addVideo');
            if(addVideo){
                addVideo.onclick = function(event) {
                        event.preventDefault();
                        chooseVideo();
                        new video();
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
                        event.preventDefault();
                        new Todo();
                };
            }

        //draw class toevoegen
            var Draw = require('./classes/draw.js');
            var addDraw = document.getElementById('draw');
            if(addDraw){
                addDraw.onclick = function(event) {
                        event.preventDefault();
                        new Draw();
                };
            }

        //random color/li.projectItem
        //De selector is niet juist!------------ ('.projectItem')
        $(document).ready(function() {
            $('.projectItem').each(function( index ) {
                $(this).css( "background-color", get_random_color());
            });
        });
	}

    function moveWhiteboardOnClick(){
        $(document).ready(function(){
            $('.addBtn').click(function(){
                event.preventDefault();
                $('.whiteboard').toggleClass("moveWBoard");
            });
        });
    }

    function chooseImage() {
      $("#imageWboard").click();
    }

    function chooseVideo() {
      $("#videoInput").click();
    }

    function get_random_color() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.round(Math.random() * 15)];
        }
        return color;
    }

	init();
    moveWhiteboardOnClick();
})();