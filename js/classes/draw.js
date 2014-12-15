module.exports = (function(){

	function Draw() {
		console.log("[Draw] Hello Jil");
	}

	paint = false;

	$('#cnvs').mousedown(function(e){
	  var mouseX = e.pageX - this.offsetLeft;
	  var mouseY = e.pageY - this.offsetTop;
	  console.log(mouseX, mouseY);
			
	  paint = true;
	  addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
	  redraw();
	});

	$('#cnvs').mousemove(function(e){
	  if(paint){
	    addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
	    redraw();
	  }
	});

	$('#cnvs').mouseup(function(e){
	  paint = false;
	});

	$('#cnvs').mouseleave(function(e){
	  paint = false;
	});

	var clickX = new Array();
	var clickY = new Array();
	var clickDrag = new Array();
	var paint;

	function addClick(x, y, dragging){
	  clickX.push(x);
	  clickY.push(y);
	  clickDrag.push(dragging);
	}

	// function redraw(){
	// 		var context = $('#cnvs');

	// 		context.strokeStyle = "#FF0000";
	// 		context.lineJoin = "round";
	// 		context.lineWidth = 10;
					
	// 		for(var i=0; i < clickX.length; i++) {		
	// 			context.beginPath();
	// 			if(clickDrag[i] && i){
	// 			  context.moveTo(clickX[i-1], clickY[i-1]);
	// 			 }else{
	// 			   context.moveTo(clickX[i]-1, clickY[i]);
	// 			 }
	// 			 context.lineTo(clickX[i], clickY[i]);
	// 			 context.closePath();
	// 			 context.stroke();
	// 			}
	// 		}

	return Draw;
})();