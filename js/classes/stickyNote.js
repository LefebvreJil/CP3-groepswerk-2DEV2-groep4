module.exports = (function(){
	var Viewfunctions = require('./Viewfunctions');

	function stickyNote() {
		//console.log("[stickyNote] Hello sticky Jil");
		var url = document.URL;
		var id_link_arr = url.split( "=" );
		var id_link = id_link_arr[2];

		var input_stickyNote = {
			text: "Klik om de tekst aan te passen",
			id: id_link
		};

		var wegschrijvenNote = $.post("index.php?page=addNote", input_stickyNote);

		wegschrijvenNote.done(function(data) {
	   	 if(data.result) {
			$('.whiteboard').empty();
			Viewfunctions();
	   	 }
	   });
	}

	return stickyNote;
})();