module.exports = (function(){

	var id_link;

	function Viewfunctions() {
		//console.log("[Class] Hello Phinodel");

		var url = document.URL;
		var id_link_arr = url.split( "=" );
		id_link = id_link_arr[2];

		todo_view();
		stickyNotes_view();
	}

	function todo_view(){
		$.get( "index.php?page=whiteboard&id="+id_link, function(data) {
			var todos = data.todos;
		  	var tpl_todos = Handlebars.compile($('#todo-template').html());
		  	var html_todos = tpl_todos(todos);
		  	$('.whiteboard').append(html_todos);
		});
	}

	function stickyNotes_view(){
		$.get( "index.php?page=whiteboard&id="+id_link, function(data) {
			var stickyNotes = data.stickyNotes;
			var tpl_stickyNotes = Handlebars.compile($('#stickyNote-template').html());
		  	var html_stickyNotes = tpl_stickyNotes(stickyNotes);

		  	$('.whiteboard').append(html_stickyNotes);

		  	console.log($('.note'));
		});
		
		stickynote_contents = document.querySelectorAll('.note');
		stickyNotes_change();
	}

	function stickyNotes_change(){
		
		//var stickynote_contents = alles.stickyNote_content;
		//console.log(stickynote_contents);
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