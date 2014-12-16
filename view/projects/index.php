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
			<span>Brainstormers van Howest, welkom!</span>
			Leg de offline wereld aan de kant om te brainstormen, vanaf nu kan je dit online doen!
			<br/>
			<br/>
			Hier maak je je brainstorms aan door op de grote plus te klikken.
			</p>
			<p class="intro">
				Klik op de titel van het project en de beschrijving om ze aan te passen.
				Klik op de grote plus om een nieuw project aan te maken. BAM je kan beginnen!<br />
				<span>Elementen die je kunt toevoegen op het whiteboard:</span>
			</p>
			<ul>
				<li class="introLi">Awesome post-its</li>
				<li class="introLi">Je eigen foto's</li>
				<li class="introLi">Zelf toegevoegde filmpjes</li>
				<li class="introLi">To-do lijstjes all the way</li>
			</ul>
			<p class="intro">Go nuts and let the brainstorm begin!</p>
		<a href="index.php?page=addProject" class="addProject" id="dikkePlus"></a>
	</section>

	<section>
		<ul id="projectList" class="projectList"></ul>
	</section>
</div>