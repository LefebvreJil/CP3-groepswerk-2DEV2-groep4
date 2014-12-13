module.exports = (function(){
	var titel;
	var beschrijving;
	var link;

	function projectIndex() {
		//console.log("[projectIndex]");
		$.get( "index.php?page=projects", function(projects) {
		  var tpl = Handlebars.compile($('#project-template').html());
		  var html = tpl(projects);
		  $('.projectList').append(html);

		  var projects_title = document.querySelectorAll('.title');
		  var projects_link = document.querySelectorAll('.link');
		  var projects_description = document.querySelectorAll('.description');

		  //titel selecteren
		  for (var i = 0; i < projects_title.length; i++) {
		  	titel = projects_title[i];
		  	link = projects_link[i];
		  	beschrijving = projects_description[i];

		  	titel.contentEditable = true;
		  	beschrijving.contentEditable = true;

	        aanpassenTitel(titel, link);
		  	aanpassenBeschrijving(beschrijving, link);
		  }

		});
	}

	function aanpassenTitel (titel, link){
		var href_link = link.getAttribute("href");
		var id_link = href_link.substring(29, 35);
		
		titel.addEventListener('keydown', function(e){
			//als er op enter gedrukt wordt dan wordt het weggeschreven naar de DB
				if(e.keyCode===13){
					e.preventDefault();
					var inhoudTitel = titel.innerText;
					var id = id_link;

					var input = {
						name: inhoudTitel,
						id: id
					};

					var SchrijfWeg = $.post("index.php?page=projects", input);

					SchrijfWeg.done(function(data){
						console.log(data);
					});
				}
			});
	}

	function aanpassenBeschrijving (beschrijving, link){
		//console.log(beschrijving);
		beschrijving.addEventListener('keydown', function(e){
				if(e.keyCode===13){
					e.preventDefault();
					console.log("ENTER");
					/*$.post( "index.php?page=index", { 
						name: beschrijving
					});*/
				}
			});
	}
	return projectIndex;
})();