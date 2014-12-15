module.exports = (function(){

	function Viewfunctions() {
		//console.log("[Class] Hello Phinodel");

		var url = document.URL;
		var id_link_arr = url.split( "=" );
		var id_link = id_link_arr[2];

		$.get( "index.php?page=whiteboard&id="+id_link, function(data) {
			var stickyNotes = data.stickyNotes;
			console.log(data);

			//var stickyNotes_perId = data.stickyNotes.id;
			//console.log(stickyNotes_perId);

			var tpl_stickyNotes = Handlebars.compile($('#stickyNote-template').html());
		  	var html_stickyNotes = tpl_stickyNotes(stickyNotes);
		  	//console.log(html_stickyNotes);

		  	$('.whiteboard').append(html_stickyNotes);
		});
	}

	function verwijderen (element, id_link){
		element.addEventListener('click', function(e){
			e.preventDefault();
			var input = {
				action : 'delete',
				id : id_link
			};

			var deleteWegSchrijven = $.post("index.php?page=whiteboard", input);
		});
	}

	/*Class.prototype.clickHandler = function(event){
		//event.preventDefault();
	}*/

	return Viewfunctions;
})();