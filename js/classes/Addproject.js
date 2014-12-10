module.exports = (function(){

	function Addproject() {
		console.log("[Addproject] Codeer Jil");

		$.post( "index.php?page=addpost", { 
			nickname: 'consult',
			subject: 'hello world',
			message: 'dit is de message om te testen'
		})
	   .done(function( data ) {
	     console.log(data);
	   	 if(data.result) {
	   		voorbeeldJSONGet();
	   	 } else {

	   	 }
	   });
	}
	return Addproject;
})();