module.exports = (function(){

	function Todo() {
		//console.log("[Todo] Hello Jil");

		var url = document.URL;
		var id_link_arr = url.split( "=" );
		var id_link = id_link_arr[2];

		var input_todo = {
			project_id: id_link
		};

		var wegschrijvenNote = $.post("index.php?page=addTodo", input_todo);

		wegschrijvenNote.done(function(data) {
			if(data.result) {
	   	 	var todo_last = [data.todo_last];

	   		$.get( "index.php?page=addTodo", function() {
			  var tpl = Handlebars.compile($('#todo-template').html());
			  var html_erbijVoegen = tpl(todo_last);
			  $('.whiteboard').append(html_erbijVoegen);
			});
	   	 }
		});
	}

	return Todo;
})();