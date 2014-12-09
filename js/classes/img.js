module.exports = (function(){

	function img() {
		console.log("[img] Hello Jil");
		this.el.contentEditable = true;
	}

	img.prototype.clickHandler = function(event){
		//event.preventDefault();
	};

	return img;
})();