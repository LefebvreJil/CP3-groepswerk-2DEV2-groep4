module.exports = (function(){

	function Viewfunctions() {
		console.log("[Class] Hello Phinodel");

		$.get( "index.php?page=whiteboard&id="+id_link, function(data) {
			console.log(data);
		});
	}

	/*Class.prototype.clickHandler = function(event){
		//event.preventDefault();
	}*/

	return Deleteproject;
})();