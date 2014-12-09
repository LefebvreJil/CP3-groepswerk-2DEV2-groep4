<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Whiteboard</title>
	<link rel="stylesheet" href="css/screen.css">
</head>
<body>
	<?php echo $content; ?>

	<script type="text/template" id="project-template">
		    {{#each .}}
		    
				<li class="projectItem">
					<article class="project">
		        		<header>
				          <h1>{{name}}</h1>
				        </header>
			        	<h2 class="tussenTitel">Sessies:</h2>

			        	<ul class="sessionList">
			        		{{#each .}}
				        		<li class="projectSession">
				        			<h1>{{name}}</h1>
				        			<a href={{"url"}}>Ga naar sessie</a>
				        		</li>
			        		{{/each}}

			        		<a href="index.php?page=addSession" class="addSession"></a>
			        	</ul>
			      	</article>
		      	</li>

		    {{/each}}
	</script>
	
	
	<script src="js/vendor/jquery.min.js"></script>
	<script src="js/vendor/handlebars.min.js"></script>
	<script src="js/vendor/modernizr.min.js"></script>
	<script src="js_dist/script.dist.js"></script>
</body>
</html>