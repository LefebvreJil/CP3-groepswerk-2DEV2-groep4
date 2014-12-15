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

		  	stickyNotes_change();
		});
	}

	function stickyNotes_change(){
		var stickynotes_allContent = $('.stickyNote_content');
		var stickynotes_allLinks = document.querySelectorAll('.deleteStickyNote');

		for (var i = 0; i < stickynotes_allContent.length; i++) {
		  	stickynote = stickynotes_allContent[i];
		  	stickynote_link = stickynotes_allLinks[i];

		  	var href_link = stickynote_link.getAttribute("href");
			var id_link_arr = href_link.split( "=" );
			var id_stickynote = id_link_arr[2];

		  	stickynote.contentEditable = true;

	        aanpassenTekst_stickyNote(stickynote, id_stickynote);
		  }
	}

	function aanpassenTekst_stickyNote (stickynote, id_stickynote){
		
		stickynote.addEventListener('keydown', function(e){
			if(e.keyCode===13){
				e.preventDefault();
				var inhoudStickynote = stickynote.innerText;

				var input = {
					text: inhoudStickynote,
					id_stickynote: id_stickynote
				};

				$.post("index.php?page=UpdateFunctie", input)
				.done(function(data){
					console.log(data);
				});


			}
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