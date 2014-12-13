module.exports = (function(){
	var titel;
	var beschrijving;

	function projectIndex() {
		//console.log("[projectIndex]");
		$.get( "index.php?page=projects", function(projects) {
		  var tpl = Handlebars.compile($('#project-template').html());
		  var html = tpl(projects);
		  $('.projectList').append(html);

		  var projects_title = document.querySelectorAll('.title');
		  var projects_description = document.querySelectorAll('.description');

		  //titel selecteren
		  for (var i = 0; i < projects_title.length; i++) {
		  	titel = projects_title[i];
		  	titel.contentEditable = true;
	        aanpassenTitel(titel);
		  }

		  //beschrijving selecteren
		  for (var x = 0; x < projects_description.length; x++) {
		  	var beschrijving = projects_description[x];
		  	beschrijving.contentEditable = true;
		  	aanpassenBeschrijving(beschrijving);
		  }

		});
	}

	function aanpassenTitel (titel){
		
		titel.addEventListener('keydown', function(e){
			//als er op enter gedrukt wordt dan wordt het weggeschreven naar de DB
				if(e.keyCode===13){
					e.preventDefault();
					var inhoudTitel = titel.innerText;

					var input = {
						name: inhoudTitel,
						id: "25"
					};

					var SchrijfWeg = $.post("index.php?page=projects", input);

					SchrijfWeg.done(function(data){
						console.log(data);
					});
				}
			});
	}

	function aanpassenBeschrijving (beschrijving){
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