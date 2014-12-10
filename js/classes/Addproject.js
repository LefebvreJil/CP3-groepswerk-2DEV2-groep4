module.exports = (function(){

	function Addproject() {
		console.log("[Addproject] Hello Jil");

		$.post( "index.php?page=addProject", { 
			name: 'Dubbelklik om aan te passen'
		})

	   .done(function( data ) {
	     //console.log(data);
	   	 if(data.result) {
	   		display();
	   	 } else {

	   	 }
	   });
	}

	function display(tpl) {
		$.get( "index.php?page=projects", function( projects ) {
		  //console.log(projects);
		  var html = tpl(projects);
		  $('.projectList').prepend(html);
		});
	}


	return Addproject;
})();