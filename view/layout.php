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
				          <h1 class="title">{{name}}</h1>
				        </header>
				        <p class="description">{{description}}</p>
				        <p>Gebruikers van dit project:</p>
				        <p class="users">Jij {{users}}</p>
				        <a class="addUser" href=""><img src="assets/img/arrow.png" alt="arrow">Voeg een user toe</a>
				        <a class="link" href="index.php?page=whiteboard&id={{id}}"><img src="assets/img/arrow.png" alt="arrow">Ga naar project</a>
			      	</article>
		      	</li>

		    {{/each}}
	</script>

	<script src="js/vendor/jquery.min.js"></script>
	<script src="js/vendor/bean.min.js"></script>
	<script src="js/vendor/handlebars.min.js"></script>
	<script src="js/vendor/modernizr.min.js"></script>
	<script src="js_dist/script.dist.js"></script>
</body>
</html>