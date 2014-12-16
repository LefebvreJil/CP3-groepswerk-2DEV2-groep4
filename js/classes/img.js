module.exports = (function(){

	var numbOfClicks = 0;

	function Img() {
		console.log("[Img] Hello Jil");

		$.post('index.php?page=addImage',{actie: 'add_img'})

		.done(function(data){
			console.log(data);
		});
	}

	function stuff(){
		$.post( "index.php?page=addProject", { 
			name: 'Klik om aan te passen',
			description: 'Klik om aan te passen, druk op enter ter bevestiging'
		})

	   .done(function(data) {
	   	 if(data.result) {
	   	 	var projects_last = [data.projects_last];

	   		$.get( "index.php?page=addProject", function() {
			  var tpl = Handlebars.compile($('#project-template').html());
			  var html_erbijVoegen = tpl(projects_last);
			  $('.projectList').append(html_erbijVoegen);
			});

			var items = $('.projectItem');
			$(items[items.length-1]).css( "background-color", get_random_color());
	   	 }
	   });
	}

	return Img;
})();