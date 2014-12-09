module.exports = (function(){
	
	var numbOfClicks = 0;

	function video() {
		console.log("[video] Hello video Jil");
	
		this.el = document.createElement('div');
		this.el.classList.add('video_vervangenDoorCirkel');

		var whiteboard = document.getElementById('whiteboard');
		whiteboard.appendChild(this.el);

		this._mouseDownHandler = this.mouseDownHandler.bind(this);
		this._mouseMoveHandler = this.mouseMoveHandler.bind(this);
		this._mouseUpHandler = this.mouseUpHandler.bind(this);

		this.el.addEventListener('mousedown', this._mouseDownHandler);
	}

	video.prototype.mouseDownHandler = function (event) {
		this.offsetX = event.offsetX;
		this.offsetY = event.offsetY;
		window.addEventListener('mousemove', this._mouseMoveHandler);
		window.addEventListener('mouseup', this._mouseUpHandler);
		numbOfClicks++;
		this.el.style.zIndex = numbOfClicks;
	};

	video.prototype.mouseMoveHandler = function (event) {
		this.el.style.left = (event.x - this.offsetX) + 'px';
		this.el.style.top = (event.y - this.offsetY )+ 'px';
	};

	video.prototype.mouseUpHandler = function (event) {
		window.removeEventListener('mousemove', this._mouseMoveHandler);
		window.removeEventListener('mouseup', this._mouseUpHandler);
	};

	return video;
})();