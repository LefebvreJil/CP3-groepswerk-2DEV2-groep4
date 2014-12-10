module.exports = (function(){

	var projectIndex = require('./projectIndex.js');

	function Addproject() {
		console.log("[Addproject] Hello Jil");

		$.post( "index.php?page=addProject", { 
			name: 'Dubbelklik om aan te passen'
		})

	   .done(function( data ) {
	     console.log(data);
	   	 if(data.result) {
	   		projectIndex();
	   	 } else {
	   	 	console.log("nee sorry");
	   	 }
	   });
	}
	return Addproject;
})();