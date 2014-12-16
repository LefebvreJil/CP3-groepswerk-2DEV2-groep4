module.exports = (function(){
	var titel;
	var beschrijving;
	var link;

	var dikkeMin;

	function projectIndex() {
		//console.log("[projectIndex]");
		$.get( "index.php?page=projects", function(data) {
			//console.log(data);
			var projects = data.projects;
		  	var tpl_projects = Handlebars.compile($('#project-template').html());
		  	var html_projects = tpl_projects(projects);
		  	$('.projectList').append(html_projects);

		  	linken();
		  	});
		  
	}

	function linken(){
		var projects_title = document.querySelectorAll('.title');
		  var projects_link = document.querySelectorAll('.link');
		  var projects_description = document.querySelectorAll('.description');

		  var alleDikkeMinnen = document.querySelectorAll('.deleteProject');

		  //titel selecteren
		  for (var i = 0; i < projects_title.length; i++) {
		  	titel = projects_title[i];
		  	link = projects_link[i];
		  	beschrijving = projects_description[i];
		  	dikkeMin = alleDikkeMinnen[i];

		  	titel.contentEditable = true;
		  	beschrijving.contentEditable = true;

		  	var href_link = link.getAttribute("href");
			var id_link_arr = href_link.split( "=" );
			var id_link = id_link_arr[2];

	        aanpassenTitel(titel, id_link);
		  	aanpassenBeschrijving(beschrijving, id_link);
		  	verwijderenProject(dikkeMin, id_link);

		  }
		  
	        $('.projectItem').each(function() {
	            $(this).css( "background-color", get_random_color());
	        });
	    

		
	}

	function get_random_color() {
        var letters = '0123456789ABCD'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.round(Math.random() * 13)];
        }
        return color;
    }

	function aanpassenTitel (titel, id_link){
		titel.addEventListener('keydown', function(e){
			//als er op enter gedrukt wordt dan wordt het weggeschreven naar de DB
			if(e.keyCode===13){
				e.preventDefault();
				var inhoudTitel = titel.innerText;

				var input = {
					name: inhoudTitel,
					id: id_link
				};

				var SchrijfWeg = $.post("index.php?page=projects", input);
				titel.blur();
			}
		});
	}

	function aanpassenBeschrijving (beschrijving, id_link){
		//console.log(beschrijving);
		beschrijving.addEventListener('keydown', function(e){
			if(e.keyCode===13){
				e.preventDefault();
				var inhoudBeschrijving = beschrijving.innerText;

				var data = {
					description: inhoudBeschrijving,
					id: id_link
				};

				var Wegschrijven = $.post("index.php?page=projects", data);
				beschrijving.blur();
			}
		});
	}

	function verwijderenProject (dikkeMin, id_link){
		dikkeMin.addEventListener('click', function(e){
			e.preventDefault();
			var input = {
				action : 'delete',
				id_project : id_link
			};

			var deleteWegSchrijvenAJAX = $.post("index.php?page=deleteProject", input);

		   deleteWegSchrijvenAJAX.done(function(data) {

		   	 	var projectList = document.querySelector('.projectList');
				var projectItems = [];
				var projectItemElement = projectList.querySelectorAll('.projectItem');
		   });
		});
	}


	return projectIndex;
})();