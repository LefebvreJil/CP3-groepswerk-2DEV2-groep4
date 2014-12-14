<div class="wrapper">
	<section class="wNav">
		<ul>
			<li><a href="index.php?page=projects">Terug</a></li>
			<li><header>
				<h1><?php echo $project['name'] ?></h1>
			</header></li>
			<li><a href="" class="addBtn">Object toevoegen</a></li>
			<li class="lastLi"><a href="index.php?page=logout" class="logoutBtn">Logout</a></li>
		</ul>
	</section>
	<div class="addObject">
		<ul>
			<div style="height:0px;overflow:hidden">
   				<input type="file" id="imageInput" name="imageInput" />
			</div>
			<li id="addImage"><a href="">Afbeelding</a></li>
			<div style="height:0px;overflow:hidden">
   				<input type="file" id="videoInput" name="videoInput" />
			</div>
			<li id="addVideo"><a href="">Video</a></li>
			<li id="addStickyNote"><a href="">Post-it</a></li>
			<li id="addTodo"><a href="">Todo Lijst</a></li>
			<li id="draw" class="lastLi"><a href="">Tekenen</a></li>
		</ul>
	</div>
	<div id="whiteboard" class="whiteboard">
	</div>
	<a href="index.php?page=projects" class="end">Keer terug naar het projectoverzicht</a>
</div>