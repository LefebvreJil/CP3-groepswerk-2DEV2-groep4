module.exports = (function(){

	//var projectIndex = require('./projectIndex.js');

	function Addproject() {
		//console.log("[Addproject] Hello Jil");
		
		$.post( "index.php?page=addProject", { 
			name: 'Dubbelklik om aan te passen'
		})

	   .done(function(data) {
	   	 if(data.result) {
	   	 	var projects_last = [data.projects_last];

	   		$.get( "index.php?page=addProject", function() {
			  var tpl = Handlebars.compile($('#project-template').html());
			  var html_erbijVoegen = tpl(projects_last);
			  $('.projectList').append(html_erbijVoegen);
			});
	   	 }
	   });
	}

	return Addproject;
})();