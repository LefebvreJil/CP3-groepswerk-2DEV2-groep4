module.exports = (function(){

	var id_link;

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

		  	var images = data.imges;
		  	var tpl_img = Handlebars.compile($('#img-template').html());
		  	var html_images = tpl_img(data.imges);
		  	$('.whiteboard').append(html_images);

		  	var videos = data.videos;
		  	var tpl_video = Handlebars.compile($('#video-template').html());
		  	var html_videos = tpl_video(data.videos);
		  	$('.whiteboard').append(html_videos);

		  	ElementenSelecteren();
		});
	}

	function ElementenSelecteren(){
		var alleImageDivs = document.querySelectorAll('.img-object');

		for (var i = 0; i < alleImageDivs.length; i++) {
		  	imgDiv = alleImageDivs[i];

		  	console.log(imgDiv);

	        //aanpassenTitel(titel, id_link);

		  }

	}

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