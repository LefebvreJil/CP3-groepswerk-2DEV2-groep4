<section class="home">
		<header class="titel">
			<h1><a href="index.php">Whiteboard</a></h1>
		</header>
		<div id="session_messages">
		    <?php if(!empty($_SESSION['info'])): ?><div class="success"><?php echo $_SESSION['info'];?></div><?php endif; ?>
		    <?php if(!empty($_SESSION['error'])): ?><div class="error"><?php echo $_SESSION['error'];?></div><?php endif; ?>
		</div>
	<div class="homeWrap">
		<section class="homeForm">
			<header>
				<h1>Registreer</h1>
			</header>
			<form id="registerForm" class="registerForm" action="index.php?page=register" method="post"  enctype="multipart/form-data">

				<div>
					<span class="error-message<?php if(empty($errors['vn'])) echo ' hidden';?>" 
					data-for="vn"> 
					Gelieve je voornaam in te vullen</span>

					<input type="text" 
					name="vn" 
					placeholder="Voornaam" 
					tabindex="1" 
					class="formItem <?php if(!empty($errors['vn'])) echo ' has-error'; ?>" 
					value="<?php if(!empty($_POST['vn'])) echo $_POST['vn'];?>"/>
				</div>
				
				<div>
					<span class="error-message<?php if(empty($errors['an'])) echo ' hidden';?>" 
					data-for="an">
					Gelieve je achternaam in te vullen</span>
					
					<input type="text" 
					name="an" 
					placeholder="Achternaam" 
					tabindex="2" 
					class="formItem <?php if(!empty($errors['an'])) echo ' has-error'; ?>" 
					value="<?php if(!empty($_POST['an'])) echo $_POST['an'];?>"/>
				</div>

				<div>
					<span class="error-message<?php if(empty($errors['nickname'])) echo ' hidden';?>" 
					data-for="nickname">
					Gelieve je nickname in te vullen</span>

					<input type="text" 
					name="nickname" 
					placeholder="Speciaal voor Fré kan je hier The Nerd invullen." 
					tabindex="3" 
					class="formItem <?php if(!empty($errors['nickname'])) echo ' has-error'; ?>" 
					value="<?php if(!empty($_POST['nickname'])) echo $_POST['nickname'];?>"/>
				</div>

				<div>
					<span class="error-message<?php if(empty($errors['email'])) echo ' hidden';?>" 
					data-for="email">
					Gelieve je email in te vullen</span>

		            <input type="email" 
		            name="email" 
		            placeholder="Email" 
		            tabindex="4" 
		            class="formItem <?php if(!empty($errors['email'])) echo ' has-error'; ?>" 
		            value="<?php if(!empty($_POST['email'])) echo $_POST['email'];?>"/>
				</div>

				<div>
					<span class="error-message<?php if(empty($errors['password'])) echo ' hidden';?>" 
					data-for="password">
					Gelieve je wachtwoord in te vullen</span>
	            	<input type="password" 
	            	name="password" 
	            	placeholder="Wachtwoord" 
	            	tabindex="5" 
	            	class="formItem <?php if(!empty($errors['password'])) echo ' has-error'; ?>" />
				</div>


				<div>
					<span class="error-message<?php if(empty($errors['repassword'])) echo ' hidden';?>" 
					data-for="repassword">
					Gelieve je wachtwoord te herhalen</span>

	            	<input type="password" 
	            	name="repassword" 
	            	placeholder="Herhaal wachtwoord" 
	            	tabindex="6" 
	            	class="formItem <?php if(!empty($errors['repassword'])) echo ' has-error'; ?>" />
				</div>

				<div>
					<span class="error-message<?php if(empty($errors['qualities'])) echo ' hidden';?>" 
					data-for="qualities">
					Gelieve je kwaliteiten in te vullen, we geloven in jou!</span>
	            	
	            	<textarea name="qualities" 
	            	cols="47" 
	            	rows="5" 
	            	placeholder="Beschrijf hier uw kwaliteiten." 
	            	tabindex="7" 
	            	class="formTextarea <?php if(!empty($errors['qualities'])) echo ' has-error'; ?>" 
	            	value="<?php if(!empty($_POST['qualities'])) echo $_POST['qualities'];?>">
	            	</textarea>
				</div>

				<div>
					<span class="error-message<?php if(empty($errors['job'])) echo ' hidden';?>" 
					data-for="job">
					Gelieve je job / studierichting in te vullen</span>
	            	<input type="text" 
	            	name="job" 
	            	placeholder="Beroep/studierichting" 
	            	tabindex="8" 
	            	class="formItem <?php if(!empty($errors['job'])) echo ' has-error'; ?>" 
	            	value="<?php if(!empty($_POST['job'])) echo $_POST['job'];?>"/>
				</div>

				<div>
					<label for="image">Kies uw profielfoto</label>
					<span class="error-message<?php if(empty($errors['image'])) echo ' hidden';?>" 
					data-for="image">
					<?php
	                	if(!empty($errors['image'])) echo $errors['image'];
                	?>
                	</span>

	            	<input type="file" 
	            	name="image" 
	            	tabindex="9" 
	            	class="formItem <?php if(!empty($errors['image'])) echo ' has-error'; ?>" />
				</div>
				<div>
					<input type="submit" 
					value="Registreer" 
					tabindex="10" 
					class="registerBtn" />
				</div>

	        </form>
		</section>
	</div>
</section>