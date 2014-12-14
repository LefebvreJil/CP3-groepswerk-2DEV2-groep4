module.exports = (function(){
	var titel;
	var beschrijving;
	var link;

	function projectIndex() {
		//console.log("[projectIndex]");
		$.get( "index.php?page=projects", function(data) {
			var projects = data.projects;
			//var usersOnProject = data.usersOnProject;

		  	var tpl_projects = Handlebars.compile($('#project-template').html());
		  	//var tpl_users = Handlebars.compile($('#users-template').html());

		  	var html_projects = tpl_projects(projects);
		  	//var html_users = tpl(usersOnProject);

		  	$('.projectList').append(html_projects);
		  	//$('.description').append(html_users);

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

		  	var href_link = link.getAttribute("href");
			var id_link = href_link.substring(29, 35);

	        aanpassenTitel(titel, id_link);
		  	aanpassenBeschrijving(beschrijving, id_link);
		  }
		  
	        $('.projectItem').each(function() {
	            $(this).css( "background-color", get_random_color());
	        });
	    

		});
	}

	function get_random_color() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.round(Math.random() * 15)];
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
			}
		});
	}
	return projectIndex;
})();