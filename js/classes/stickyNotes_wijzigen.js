module.exports = (function(){

	//var numbOfClicks = 0;

	function stickyNotes_wijzigen() {
		/*console.log("[stickyNote] Hello sticky Jil wijzigen");
		$.get( "index.php?page=projects", function(data) {
			var projects = data.projects;
			var tpl_projects = Handlebars.compile($('#project-template').html());
			var html_projects = tpl_projects(projects);
			console.log(html_projects);


		//console.log(whiteboard);
		/*var url = document.URL;
		var id_link_arr = url.split( "=" );
		var id_link = id_link_arr[2];*/

		//var stickynote_contents = whiteboard.querySelectorAll('.note');
		//var stickynote_contents = alles.stickyNote_content;
		//console.log(alle_stickyNotes);

		//var whiteboard = document.querySelectorAll('.note');

		//var childs_whiteboard = whiteboard[0];
		
	//});



		//var stickynote_contents = document.querySelectorAll('.title');
		//var stickynote_contents = alles.stickyNote_content;
		//console.log(alles);
		

		//for (var i = 0; i < stickynotes.length; i++) {
		  	//content = stickynotes[i];
		  	//console.log(content);

		  	/*titel.contentEditable = true;
		  	beschrijving.contentEditable = true;

		  	var href_link = link.getAttribute("href");
			var id_link_arr = href_link.split( "=" );
			var id_link = id_link_arr[2];

	        aanpassenTitel(titel, id_link);
		  	aanpassenBeschrijving(beschrijving, id_link);
		  	verwijderenProject(dikkeMin, id_link);*/

		  //}

		

		/*this._mouseDownHandler = this.mouseDownHandler.bind(this);
		this._mouseMoveHandler = this.mouseMoveHandler.bind(this);
		this._mouseUpHandler = this.mouseUpHandler.bind(this);

		this.el.addEventListener('mousedown', this._mouseDownHandler);*/
	}

	/*stickyNote.prototype.mouseDownHandler = function (event) {
		this.offsetX = event.offsetX;
		this.offsetY = event.offsetY;
		window.addEventListener('mousemove', this._mouseMoveHandler);
		window.addEventListener('mouseup', this._mouseUpHandler);
		numbOfClicks++;
		this.el.style.zIndex = numbOfClicks;
	};

	stickyNote.prototype.mouseMoveHandler = function (event) {
		this.el.style.left = (event.x - this.offsetX) + 'px';
		this.el.style.top = (event.y - this.offsetY )+ 'px';
	};

	stickyNote.prototype.mouseUpHandler = function (event) {
		window.removeEventListener('mousemove', this._mouseMoveHandler);
		window.removeEventListener('mouseup', this._mouseUpHandler);
	};*/

	return stickyNotes_wijzigen;
})();