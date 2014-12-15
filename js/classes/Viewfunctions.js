module.exports = (function(){

	function Viewfunctions() {
		//console.log("[Class] Hello Phinodel");

		var url = document.URL;
		var id_link_arr = url.split( "=" );
		var id_link = id_link_arr[2];

		$.get( "index.php?page=whiteboard&id="+id_link, function(data) {
			var stickyNotes = data.stickyNotes;

			var tpl_stickyNotes = Handlebars.compile($('#stickyNote-template').html());
		  	var html_stickyNotes = tpl_stickyNotes(stickyNotes);
		  	console.log(html_stickyNotes);

		  	$('.whiteboard').append(html_stickyNotes);
		});
	}

	/*Class.prototype.clickHandler = function(event){
		//event.preventDefault();
	}*/

	return Viewfunctions;
})();