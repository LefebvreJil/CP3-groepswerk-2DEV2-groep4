module.exports = (function(){
	function projectIndex() {
		//console.log("[projectIndex]");
		$.get( "index.php?page=projects", function(projects) {
		  var tpl = Handlebars.compile($('#project-template').html());
		  var html = tpl(projects);
		  $('.projectList').append(html);

		  var projects_title = document.querySelectorAll('.title');
		  var projects_description = document.querySelectorAll('.description');

		  for (var i = 0; i < projects_title.length; i++) {
		  	projects_title[i].contentEditable = true;
		  }

		  for (var x = 0; x < projects_description.length; x++) {
		  	projects_description[x].contentEditable = true;
		  }

		});

		//titel kunnen aanpassen
	}
	return projectIndex;
})();