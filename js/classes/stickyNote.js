module.exports = (function(){

	var numbOfClicks = 0;

	function stickyNote() {
		//console.log("[stickyNote] Hello sticky Jil");

		/*var input_stickyNote = {
			color: "get_random_color()",
			rotation: "5",
			text: "Klik om de tekst aan te passen"
		};*/

		var input_stickyNote = {stuff : "okJS"};

		$.post("index.php?page=whiteboard", input_stickyNote);

		//stickyNote-template

		this.el = document.createElement('div');
		this.el.classList.add('postIt_vervangenDoorCirkel');

		var whiteboard = document.getElementById('whiteboard');
		whiteboard.appendChild(this.el);

		this._mouseDownHandler = this.mouseDownHandler.bind(this);
		this._mouseMoveHandler = this.mouseMoveHandler.bind(this);
		this._mouseUpHandler = this.mouseUpHandler.bind(this);

		this.el.addEventListener('mousedown', this._mouseDownHandler);
	}

	stickyNote.prototype.mouseDownHandler = function (event) {
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
	};

	function get_random_color() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.round(Math.random() * 15)];
        }
        return color;
    }

	return stickyNote;
})();