<div class="navBar">
	<a href="" class="backBtn">Welkom <?php echo $_SESSION['user']['nickname']; ?></a>
	<a href="" class="addBtn">Add</a>
	<a href="index.php?page=logout" class="logoutBtn">Logout</a>
</div>
<div class="wrapper">
	<section class="projectPannel">
		<header>
			<h1>Whiteboard <span>projects</span></h1>
		</header>
		<p class="intro">
			Hier komt tekst over wat de bedoeling van deze opdracht is en wat u met deze applicatie allemaal zou kunnen doen. Deze applicatie is bedoeld om brainstormsessies te houden met uw collega's. Wij bieden u een bord aan waar u post-its, foto's, filmpjes, tekeningen en nog meer kan op plakken. <br /><br />Verder zal ik hier nog een beetje zeveren om wat plaats te vullen want deze inhoude hebben we nog niet besproken. Anyway, dit lijkt genoeg te zijn denk ik. <br /><br /> Go nuts and let the brainstorm begin!
		</p>
		<a href="index.php?page=addProject" class="addProject">Add project</a>
	</section>
	<ul class="projectList">
		<li class="projectItem">
			<section class="project">
				<header>
					<h1>Mooi zo.</h1>
				</header>
				<p class="tussenTitel">Sessie's:</p>
				<ul class="sessionList">
					<li class="projectSession">
						Sessie 1
						<a href="">Ga naar sessie</a>
					</li>
					<li class="projectSession">
						Sessie 2
						<a href="">Ga naar sessie</a>
					</li>
					<a href="index.php?page=addSession" class="addSession"></a>
				</ul>
			</section>
		</li>
		<li class="projectItem">
			<section class="project">
				<header>
					<h1>Niet mooi zo.</h1>
				</header>
				<p class="tussenTitel">Sessie's:</p>
				<ul class="sessionList">
					<li class="projectSession">
						Sessie 1
						<a href="">Ga naar sessie</a>
					</li>
					<a href="index.php?page=addSession" class="addSession"></a>
				</ul>
			</section>
		</li>
	</ul>
</div>