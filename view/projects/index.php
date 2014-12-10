<div class="navBar">
	<a href="" class="backBtn">Welkom <?php echo $_SESSION['user']['nickname']; ?></a>
	<a href="index.php?page=logout" class="logoutBtn">Logout</a>
</div>

<div class="wrapper">
	<section class="projectPannel">
		<header>
			<h1>Whiteboard <span>projects</span></h1>
		</header>
		<p class="intro">
			Brainstormers van Howest, welkom!
			Leg de offline wereld aan de kant om te brainstormen, vanaf nu kan je dit online doen!
			<br/>
			<br/>
			Hier maak je je brainstorms aan door op de grote plus te klikken.
			<ul>
				<li>Dubbelklik op de titel van het project en de beschrijving om ze aan te passen.</li>
				<li>Klik op het vlak om naar het whiteboard zelf te gaan.</li>
				<li>Elementen die je kunt toevoegen op het whiteboard</li>
					<ol>
						<li>Motherf*ing post-its</li>
						<li>Flipping foto's</li>
						<li>Awesome filmpjes</li>
						<li>Tekenen 'n shit</li>
						<li>En zoveel meer!</li>
					</ol>
			</ul>
			<br/> Go nuts and let the brainstorm begin!
		</p>
		<a href="index.php?page=addProject" class="addProject"></a>
	</section>

	<section>
		<ul class="projectList"></ul>
	</section>
</div>