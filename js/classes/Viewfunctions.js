module.exports = (function(){

	var id_link;
    var numbOfClicks = 0;
    var images, videos, stickyNotes;
    var id_element;
    var TodoApplication = require('./TodoApplication');
    var dragNdrop = require('./dragNdrop');


	function Viewfunctions() {
		//console.log("[Class] Hello Phinodel");

		var url = document.URL;
		var id_link_arr = url.split( "=" );
		id_link = id_link_arr[2];
		view();
	}

	function view(){
		$.get( "index.php?page=whiteboard&id="+id_link, function(data) {

		  	stickyNotes = data.stickyNotes;
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
		for (var i = 0; i < alleVideoDivs.length; i++) {
			var extensionVid = videos[i].extension;
			var xVid = videos[i].xPos;
			var yVid = videos[i].yPos;
			var idVid = videos[i].id;
			new dragNdrop(alleVideoDivs[i],extensionVid,xVid,yVid,idVid,id_link);
		 }

		//IMGs
		var alleImageDivs = document.querySelectorAll('.img-object');
		
		for (var k = 0; k < alleImageDivs.length; k++) {
			var extensionImg = images[k].extension;
			var xImg = images[k].xPos;
			var yImg = images[k].yPos;
			var idImg = images[k].id;
			new dragNdrop(alleImageDivs[k],extensionImg,xImg,yImg,idImg,id_link);
		 }

		 //STICKYNOTES
		var alleStickyDivs = document.querySelectorAll('.note');
		
		for (var l = 0; l < alleStickyDivs.length; l++) {
			var extensionSticky = "sticky";
			var xSticky = stickyNotes[l].xPos;
			var ySticky = stickyNotes[l].yPos;
			var idSticky = stickyNotes[l].id;
			new dragNdrop(alleStickyDivs[l],extensionSticky,xSticky,ySticky,idSticky,id_link);
		 }
	}

	function stickyNotes_change(){
		var stickynotes_allContent = $('.stickyNote_content');
		var stickynotes_allLinks = document.querySelectorAll('.deleteStickyNote');

		for (var i = 0; i < stickynotes_allContent.length; i++) {
		  	stickynote = stickynotes_allContent[i];
		  	stickynote_link = stickynotes_allLinks[i];
		  	var id_stickynote = stickyNotes[i].id;
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