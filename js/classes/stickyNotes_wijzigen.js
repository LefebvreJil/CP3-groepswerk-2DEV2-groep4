module.exports = (function(){

	var numbOfClicks = 0;

	function stickyNotes_wijzigen(whiteboard) {
		//console.log("[stickyNote] Hello sticky Jil wijzigen");

		console.log(whiteboard);
		var url = document.URL;
		var id_link_arr = url.split( "=" );
		var id_link = id_link_arr[2];

		var stickynotes_all = whiteboard.querySelectorAll('notes');
		console.log(stickynotes_all);

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