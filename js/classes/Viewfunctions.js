module.exports = (function(){

	var id_link;
    var numbOfClicks = 0;
    var images, videos;
    var id_element;


	function Viewfunctions() {
		//console.log("[Class] Hello Phinodel");

		var url = document.URL;
		var id_link_arr = url.split( "=" );
		id_link = id_link_arr[2];

		view();
	}

	function view(){
		$.get( "index.php?page=whiteboard&id="+id_link, function(data) {

			var todos = data.todos;
		  	var tpl_todos = Handlebars.compile($('#todo-template').html());
		  	var html_todos = tpl_todos(todos);
		  	$('.whiteboard').append(html_todos);

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
		var alleImageDivs = document.querySelectorAll('.img-object');
		var img_xPossen;
		var img_yPossen;

		for (var i = 0; i < alleImageDivs.length; i++) {
		  	img_xPossen = images[i].xPos;
		  	img_yPossen = images[i].yPos;
		 }

		dragNdrop(alleImageDivs, img_xPossen, img_yPossen);

		var alleVideoDivs = document.querySelectorAll('.video-object');
		var video_xPossen;
		var video_yPossen;
		for (var j = 0; j < alleImageDivs.length; j++) {
		  	video_xPossen = videos[j].xPos;
		  	video_yPossen = videos[j].yPos;
		 }
		dragNdrop(alleVideoDivs, video_xPossen, video_yPossen);

		

	}

	function dragNdrop(elementen, xPossen, yPossen){

		for (var i = 0; i < elementen.length; i++) {
		  	element = elementen[i];
		  	console.log(element.getAttribute("alt"));
		  	var xPos = xPossen[i];
		  	var yPos = yPossen[i];
		  	element.style.top = xPos+'px';
			element.style.left = yPos+'px';

			element.addEventListener('mousedown', mouseDownHandler);
		 }
	}

	mouseDownHandler = function (event) {
		element.offsetX = event.offsetX;
		element.offsetY = event.offsetY;

		window.addEventListener('mousemove', mouseMoveHandler);
		window.addEventListener('mouseup', mouseUpHandler);

		numbOfClicks++;
		element.style.zIndex = numbOfClicks;
	};

	mouseMoveHandler = function (event) {
		element.style.left = (event.x - element.offsetX) + 'px';
		element.style.top = (event.y - element.offsetY )+ 'px';

		if(element.className==="video-object"){
			var doorsturen = {
					className: element.className,
					xPos: element.style.left,
					yPos: element.style.top
				};
			$.post("index.php?page=whiteboard&id="+id_link, doorsturen)
			.done(function(data){
				console.log(data.dataPost);
			});
		}

		//var SchrijfWeg = $.post("index.php?page=projects", input);
	};

	mouseUpHandler = function (event) {
		window.removeEventListener('mousemove', mouseMoveHandler);
		window.removeEventListener('mouseup', mouseUpHandler);
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