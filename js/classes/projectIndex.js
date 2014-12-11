module.exports = (function(){
	function projectIndex() {
		//console.log("[projectIndex]");
		$.get( "index.php?page=projects", function(projects) {
		  var tpl = Handlebars.compile($('#project-template').html());
		  var html = tpl(projects);
		  $('.projectList').append(html);
		});
	}
	return projectIndex;
})();