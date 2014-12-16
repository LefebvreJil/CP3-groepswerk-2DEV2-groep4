module.exports = (function(){

	var id_link;
    var numbOfClicks = 0;
    var images, videos;
    var id_element;
    var TodoApplication = require('./TodoApplication');


	function Viewfunctions() {
		//console.log("[Class] Hello Phinodel");

		var url = document.URL;
		var id_link_arr = url.split( "=" );
		id_link = id_link_arr[2];

		view();
	}

	function view(){
		$.get( "index.php?page=whiteboard&id="+id_link, function(data) {

			// var todos = data.todos;
		 //  	var tpl_todos = Handlebars.compile($('#todo-template').html());
		 //  	var html_todos = tpl_todos(todos);
		 //  	$('.whiteboard').append(html_todos);

		  	var stickyNotes = data.stickyNotes;
			var tpl_stickyNotes = Handlebars.compile($('#stickyNote-template').html());
		  	var html_stickyNotes = tpl_stickyNotes(stickyNotes);
		  	$('.whiteboard').append(html_stickyNotes);
		  	stickyNotes_change();

		  	images = data.imges;
		  	var tpl_img = Handlebars.compile($('#img-template').html());
		  	var html_images = tpl_img(data.imges);
		  	$('.whiteboard').append(html_images);

		  	videos = data.videos;
		  	var tpl_video = Handlebars.compile($('#video-template').html());
		  	var html_videos = tpl_video(data.videos);
		  	$('.whiteboard').append(html_videos);

		  	ElementenSelecteren();
		});
	}

	function ElementenSelecteren(){
		//TODO
		var todoApps = document.querySelectorAll('.todo');
		for(var j = 0; j < todoApps.length; j++){
			new TodoApplication(todoApps[j]);
		}

		//VIDs
		var alleVideoDivs = document.querySelectorAll('.video-object');
		dragNdrop(alleVideoDivs);

		//IMGs
		var alleImageDivs = document.querySelectorAll('.img-object');
		dragNdrop(alleImageDivs);

		

	}

	function dragNdrop(elementen){

		for (var i = 0; i < elementen.length; i++) {
		  	element = elementen[i];
		  	id_element = element.getAttribute('id');

		  	_mouseDownHandler = mouseDownHandler.bind(element);
			_mouseMoveHandler = mouseMoveHandler.bind(element);
			_mouseUpHandler = mouseUpHandler.bind(element);

			element.addEventListener('mousedown', _mouseDownHandler);
		 }
	}

	mouseDownHandler = function (event) {
		console.log(element);
		element.offsetX = event.offsetX;
		element.offsetY = event.offsetY;

		window.addEventListener('mousemove', _mouseMoveHandler);
		window.addEventListener('mouseup', _mouseUpHandler);

		numbOfClicks++;
		element.style.zIndex = numbOfClicks;
	};

	mouseMoveHandler = function (event) {
		element.style.left = (event.x - element.offsetX) + 'px';
		element.style.top = (event.y - element.offsetY )+ 'px';
	};

	mouseUpHandler = function (event) {
			var doorsturen = {
					className: element.className,
					xPos: event.x - element.offsetX,
					yPos: event.y - element.offsetY,
					id: id_element
				};
			$.post("index.php?page=whiteboard&id="+id_link, doorsturen)
			.done(function(data){
				console.log(data.dataPost);
			});
		

		window.removeEventListener('mousemove', _mouseMoveHandler);
		window.removeEventListener('mouseup', _mouseUpHandler);
	};



	function stickyNotes_change(){
		var stickynotes_allContent = $('.stickyNote_content');
		var stickynotes_allLinks = document.querySelectorAll('.deleteStickyNote');

		for (var i = 0; i < stickynotes_allContent.length; i++) {
		  	stickynote = stickynotes_allContent[i];
		  	stickynote_link = stickynotes_allLinks[i];

		  	var href_link = stickynote_link.getAttribute("href");
			var id_link_arr = href_link.split( "=" );
			var id_stickynote = id_link_arr[2];

		  	stickynote.contentEditable = true;

	        aanpassenTekst_stickyNote(stickynote, id_stickynote);
		  }
	}

	function aanpassenTekst_stickyNote (stickynote, id_stickynote){
		
		stickynote.addEventListener('keydown', function(e){
			if(e.keyCode===13){
				e.preventDefault();
				var inhoudStickynote = stickynote.innerText;

				var input = {
					text: inhoudStickynote,
					id_stickynote: id_stickynote
				};

				$.post("index.php?page=UpdateFunctie", input);
				stickynote.blur();


			}
		});
	}

	return Viewfunctions;
})();