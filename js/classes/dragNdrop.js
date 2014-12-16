module.exports = (function(){

	var numbOfClicks = 0;

	function dragNdrop(element,extension,x,y,id, id_link){
		this.el = element;
		this.extension=extension;
		this.id = id;
		this.id_link = id_link;

		this.el.style.top = x +'px';
		this.el.style.left = y +'px';

		this._mouseDownHandler = this.mouseDownHandler.bind(this);
		this._mouseMoveHandler = this.mouseMoveHandler.bind(this);
		this._mouseUpHandler = this.mouseUpHandler.bind(this);

		this.el.addEventListener('mousedown', this._mouseDownHandler);
	}

	dragNdrop.prototype.mouseDownHandler = function (event) {

		this.offsetX = event.offsetX;
		this.offsetY = event.offsetY;

		window.addEventListener('mousemove', this._mouseMoveHandler);
		window.addEventListener('mouseup', this._mouseUpHandler);

		numbOfClicks++;
		this.el.style.zIndex = numbOfClicks;
	};

	dragNdrop.prototype.mouseMoveHandler = function (event) {
		this.x=event.x - this.offsetX;
		this.y=event.y - this.offsetY;
		this.el.style.left = (event.x - this.offsetX) + 'px';
		this.el.style.top = (event.y - this.offsetY)+ 'px';
	};

	dragNdrop.prototype.mouseUpHandler = function (event) {
		var doorsturen = {
				extension: this.extension,
				xPos: this.x,
				yPos: this.y,
				id: this.id
			};
		$.post("index.php?page=whiteboard&id="+this.id_link, doorsturen);

		window.removeEventListener('mousemove', this._mouseMoveHandler);
		window.removeEventListener('mouseup', this._mouseUpHandler);
	};

	return dragNdrop;
})();