module.exports = (function(){

	/*
	$( document ).ready(function() {
                console.log( "ready!" );
                new projectIndex(tpl);
            });
	*/

	var projectIndex = require('./projectIndex.js');

	function Addproject(tpl) {
		console.log("[Addproject] Hello Jil");

		$.post( "index.php?page=addProject", { 
			name: 'Dubbelklik om aan te passen'
		})

	   .done(function(data) {
	   	 if(data.result) {
	   		projectIndexAdded(data, tpl);
	   	 } else {
	   	 	console.log("nee sorry");
	   	 }
	   });
	}

	function projectIndexAdded(data,tpl) {
		var projects = data.projects;
		console.log(projects);
		
		$.get( "index.php?page=projects", function(projects) {
		  console.log("ok");
		  var html = tpl(projects);
		  $('.projectList').prepend(html);
		});
	}
	return Addproject;
})();