<section class="home">
		<header class="titel">
			<h1><a href="index.php">Whiteboard</a></h1>
		</header>
	<div class="homeWrap">
		<section class="homeForm">
			<header>
				<h1>Registreer</h1>
			</header>
			<form class="registerForm" action="index.php" method="post">
				<input type="text" name="vn" placeholder="Voornaam" class="formItem" />
				<input type="text" name="an" placeholder="Achternaam" class="formItem" />
				<input type="text" name="nickname" placeholder="Speciaal voor Fr&eacute; kan je hier The Nerd invullen." class="formItem" />
	            <input type="email" name="email" placeholder="Email" class="formItem" />
	            <input type="password" name="password" placeholder="Wachtwoord" class="formItem" />
	            <input type="password" name="repassword" placeholder="Herhaal wachtwoord" class="formItem" />
	            <textarea name="qualities" cols="47" rows="5" placeholder="Beschrijf hier uw kwaliteiten." class="formTextarea"></textarea>
	            <input type="text" name="job" placeholder="Beroep / studierichting" class="formItem" />
	            <label for="image">Kies uw profielfoto</label>
	            <input type="file" name="image" class="formInput" value="Kies uw profielfoto"/>	       
	            <input type="submit" value="Registreer" class="registerBtn" />
	        </form>
		</section>
	</div>
</section>