(function(){
	
	function init() {
		console.log("[Script.js] Een goede en productieve dag gewenst aan Jil");

        //template selecteren
        var tpl = Handlebars.compile($('#project-template').html());
        var projectIndex = require('./classes/projectIndex.js');
        new projectIndex(tpl);

        var validatie = require('./classes/validatie.js');
        new validatie();
		
	}

	init();
})();