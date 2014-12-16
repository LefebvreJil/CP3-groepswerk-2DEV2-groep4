<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Whiteboard</title>
	<link rel="stylesheet" href="css/screen.css">
</head>
<body>
	<div id="content"><?php echo $content; ?></div>
	

	<script type="text/template" id="project-template">
		    {{#each .}}
				<li class="projectItem">
					<article class="project">
		        		<header>
				          <h1 class="title">{{name}}</h1>
				        </header>
				        <p class="description">{{description}}</p>
				        <a class="deleteProject" href=""><img src="assets/img/arrow.png" alt="arrow">Verwijder project</a>
				        <a class="link" href="index.php?page=whiteboard&id={{id}}"><img src="assets/img/arrow.png" alt="arrow">Ga naar project</a>
			      	</article>
		      	</li>

		    {{/each}}
	</script>

	<script type="text/template" id="stickyNote-template">
		{{#each .}}
			<div class="note" id="{{id}}">
				<p class="stickyNote_content">{{text}}</p>
			</div>
		{{/each}}
	</script>

	<script id="todo-template" type="text/template">
		<li class="todo-item">
	  		<label class="todo-item-label">
				<input type="checkbox" class="todo-item-checkbox">
				<span class="todo-item-text">{{.}}</span>
				<button class="btn btn-delete">Delete</button>
	  		</label>
	  	</li>
	</script>

	<script type="text/template" id="img-template">
		{{#each .}}
			<div class="img-object" id="{{id}}">
				<img src="./uploads/{{file}}_th.{{extension}}" alt="{{file}}"/>
			</div>
		{{/each}}
	</script>

	<script type="text/template" id="video-template">
		{{#each .}}
			<div class="video-object" id="{{id}}">
				<video controls src="./uploads/{{file}}.{{extension}}" alt="{{file}}" width="250"/>
			</div>
		{{/each}}
	</script>

	<script src="js/vendor/jquery.min.js"></script>
	<script src="js/vendor/bean.min.js"></script>
	<script src="js/vendor/handlebars.min.js"></script>
	<script src="js/vendor/modernizr.min.js"></script>
	<script src="js_dist/script.dist.js"></script>
</body>
</html>