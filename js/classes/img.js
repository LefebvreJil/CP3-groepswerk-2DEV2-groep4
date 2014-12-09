module.exports = (function(){

	function Img() {
		console.log("[Img] Hello Jil");
		//this.el.contentEditable = true;

		this.el = document.createElement('div');
		this.el.classList.add('block');

		this.el.style.top = '50 px';
		this.el.style.left = '50 px';

		//maken dat de meegegeven 'this' het div-elementje is
		this._mouseDownHandler = this.mouseDownHandler.bind(this);
		this._mouseMoveHandler = this.mouseMoveHandler.bind(this);
		this._mouseUpHandler = this.mouseUpHandler.bind(this);

		//functie mousedownhandler aan block-element toevoegen
		this.el.addEventListener('mousedown', this._mouseDownHandler);
	}

	Img.prototype.mouseDownHandler = function (event) {

		this.offsetX = event.offsetX;
		this.offsetY = event.offsetY;

		window.addEventListener('mousemove', this._mouseMoveHandler);
		window.addEventListener('mouseup', this._mouseUpHandler);

		numbOfClicks++;
		this.el.style.zIndex = numbOfClicks;
	};

	Img.prototype.mouseMoveHandler = function (event) {
		console.log("mouseMoveHandler");
		this.el.style.left = (event.x - this.offsetX) + 'px';
		this.el.style.top = (event.y - this.offsetY )+ 'px';
	};

	Img.prototype.mouseUpHandler = function (event) {
		console.log("mouseUpHandler");

		window.removeEventListener('mousemove', this._mouseMoveHandler);
		window.removeEventListener('mouseup', this._mouseUpHandler);
	};

	return Img;
})();