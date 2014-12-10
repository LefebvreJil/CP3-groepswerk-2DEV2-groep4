module.exports = (function(){

	var projectIndex = require('./projectIndex.js');
	var url = 'index.php?page=projects';

	function Addproject() {
		console.log("[Addproject] Hello Jil");

		$.post( "index.php?page=addProject", { 
			name: 'Dubbelklik om aan te passen'
		})

	   .done(function( data ) {
	     console.log(data);
	   	 if(data.result) {
	   		//projectIndex();
	   		//location.reload();
	   		$('.projectList').load(document.URL +  ' .projectList');
	   	 } else {
	   	 	console.log("nee sorry");
	   	 }
	   });
	}
	return Addproject;
})();