module.exports = (function(){

	function projectIndex(tpl) {
		//console.log("[projectIndex]");
		
		$.get( "index.php?page=projects", function( projects ) {
		  //console.log(projects);
		  var html = tpl(projects);
		  $('.projectList').prepend(html);
		});
	}

	return projectIndex;
})();