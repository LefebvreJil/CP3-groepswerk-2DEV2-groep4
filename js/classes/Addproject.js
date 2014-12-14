module.exports = (function(){
	function Addproject() {
		//console.log("[Addproject] Hello Jil");
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

	function get_random_color() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.round(Math.random() * 15)];
        }
        return color;
    }

	return Addproject;
})();