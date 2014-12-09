module.exports = (function(){

	function img() {
		console.log("[img] Hello Jil");
		//this.el.contentEditable = true;

		this.el = document.createElement('div');
		this.el.classList.add('block');

		this.el.style.top = '50 px';
		this.el.style.left = '50 px';
	}

	img.prototype.clickHandler = function(event){
		//event.preventDefault();
	};

	return img;
})();