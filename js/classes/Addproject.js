module.exports = (function(){
	var projectIndex = require('./projectIndex.js');
            
	function Addproject() {
		//console.log("[Addproject] Hello Jil");
		$.post( "index.php?page=addProject", { 
			name: 'Klik om aan te passen',
			description: 'Klik om aan te passen, druk op enter ter bevestiging'
		})

	   .done(function(data) {
	   	 if(data.result) {
			$('.projectList').empty();
			projectIndex();
	   	 }
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

	return Addproject;
})();