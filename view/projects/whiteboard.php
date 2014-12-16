<div class="wrapper">
	<section class="wNav">
		<ul>
			<li><a href="index.php?page=projects">Terug</a></li>
			<li>
				<header>
					<h1><?php echo $project['name'] ?></h1>
				</header>
			</li>
			<li><a href="" class="addBtn">Object toevoegen</a></li>
			<li class="lastLi"><a href="index.php?page=logout" class="logoutBtn">Logout</a></li>
		</ul>
	</section>
	<div class="addObject">
		<ul class="addObjectUl hide">
			<li>
				<ul>
					<li class="underLi">
						<form id="imageform" method="post" action="index.php?page=whiteboard&amp;id=<?php echo $_GET['id'] ?>" class="formAdd" enctype="multipart/form-data">
							<label for="image" id="addImage">Afbeelding</label>
							<input type="file" name="image" id="imageWboard" />
							<input type="submit" value="Plaats" class="imageBtn" id="imageSubmit" />
						</form>
					</li>
					<li class="underLi">
						<form id="videoform" method="post" action="index.php?page=whiteboard&amp;id=<?php echo $_GET['id'] ?>" class="formAdd" enctype="multipart/form-data">
							<label for="video" id="addVideo">Video</label>
							<input type="file" name="video" id="videoWboard" />
							<input type="submit" value="Plaats" class="videoBtn" id="videoSubmit" />
						</form>
					</li>
				</ul>
			</li>
			<li>
				<ul>
					<li id="addStickyNote" class=" firstLi addItem"><a href="">Post-it</a></li>
					<li id="addTodo" class="addItem"><a href="">Todo Lijst</a></li>
					<li id="draw" class="lastLi addItem"><a href="">Tekenen</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div id="whiteboard" class="whiteboard">
		<!--<canvas id="cnvs" width="1200" height="800"></canvas>-->
		<div class="todo">
			<header>
				<h1>Nog te doen</h1>
			</header>
			<ul class="todo-list">
		 	</ul>
		  <form class="todo-input-form" method="post" action="index.php?page=whiteboard&amp;id=<?php echo $_GET['id'] ?>">
		  	<input type="text" class="todo-input" placeholder="Type en druk enter." />
		  </form>
		</div>
	</div>
	<a href="index.php?page=projects" class="end">Keer terug naar het projectoverzicht</a>
</div>