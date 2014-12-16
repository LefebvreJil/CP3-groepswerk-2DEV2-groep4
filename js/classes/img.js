module.exports = (function(){

	//drag n drop
    var dragNdrop = require('./dragNdrop.js');
    

	function Img() {
		//console.log("[Img] Hello Jil");

		var selectAllImg = $('.img-object');
		console.log(selectAllImg);
		new dragNdrop();
	}

	return Img;
})();