module.exports = (function(){

	var numbOfClicks = 0;

	function Todo() {
		console.log("[Todo] Hello Jil");

		var url = document.URL;
		var id_link_arr = url.split( "=" );
		var id_link = id_link_arr[2];

		var input_todo = {
			project_id: id_link
		};

		var wegschrijvenNote = $.post("index.php?page=addTodo", input_todo);

		wegschrijvenNote.done(function(data) {
			console.log(data);
		});
	}

	return Todo;
})();