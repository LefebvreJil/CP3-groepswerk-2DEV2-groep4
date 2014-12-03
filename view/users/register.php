<section class="home">
		<header class="titel">
			<h1><a href="index.php">Whiteboard</a></h1>
		</header>
	<div class="homeWrap">
		<section class="homeForm">
			<header>
				<h1>Registreer</h1>
			</header>
			<form class="registerForm" action="index.php?page=register" method="post"  enctype="multipart/form-data">

				<span class="error-message<?php if(empty($errors['vn'])) echo ' hidden';?>" data-for="vn"><?php
	                if(!empty($errors['vn'])) echo $errors['vn'];
                ?></span>
				<input type="text" name="vn" placeholder="Voornaam" class="formItem <?php if(!empty($errors['vn'])) echo ' has-error'; ?>" value="<?php if(!empty($_POST['vn'])) echo $_POST['vn'];?>"/>


				<span class="error-message<?php if(empty($errors['an'])) echo ' hidden';?>" data-for="an"><?php
	                if(!empty($errors['an'])) echo $errors['an'];
                ?></span>
				<input type="text" name="an" placeholder="Achternaam" class="formItem <?php if(!empty($errors['an'])) echo ' has-error'; ?>" value="<?php if(!empty($_POST['an'])) echo $_POST['an'];?>"/>

				<span class="error-message<?php if(empty($errors['nickname'])) echo ' hidden';?>" data-for="nickname"><?php
	                if(!empty($errors['nickname'])) echo $errors['nickname'];
                ?></span>
				<input type="text" name="nickname" placeholder="Speciaal voor Fré kan je hier The Nerd invullen." class="formItem <?php if(!empty($errors['nickname'])) echo ' has-error'; ?>" value="<?php if(!empty($_POST['nickname'])) echo $_POST['nickname'];?>"/>
	            
				<span class="error-message<?php if(empty($errors['email'])) echo ' hidden';?>" data-for="email"><?php
	                if(!empty($errors['email'])) echo $errors['email'];
                ?></span>
	            <input type="email" name="email" placeholder="Email" class="formItem <?php if(!empty($errors['email'])) echo ' has-error'; ?>" value="<?php if(!empty($_POST['email'])) echo $_POST['email'];?>"/>
	            
				<span class="error-message<?php if(empty($errors['password'])) echo ' hidden';?>" data-for="password"><?php
	                if(!empty($errors['password'])) echo $errors['password'];
                ?></span>
	            <input type="password" name="password" placeholder="Wachtwoord" class="formItem <?php if(!empty($errors['password'])) echo ' has-error'; ?>" />
	            
				<span class="error-message<?php if(empty($errors['repassword'])) echo ' hidden';?>" data-for="repassword"><?php
	                if(!empty($errors['repassword'])) echo $errors['repassword'];
                ?></span>
	            <input type="password" name="repassword" placeholder="Herhaal wachtwoord" class="formItem <?php if(!empty($errors['repassword'])) echo ' has-error'; ?>" />
	            
				<span class="error-message<?php if(empty($errors['qualities'])) echo ' hidden';?>" data-for="qualities"><?php
	                if(!empty($errors['qualities'])) echo $errors['qualities'];
                ?></span>
	            <textarea name="qualities" cols="47" rows="5" placeholder="Beschrijf hier uw kwaliteiten." class="formTextarea <?php if(!empty($errors['qualities'])) echo ' has-error'; ?>" value="<?php if(!empty($_POST['qualities'])) echo $_POST['qualities'];?>"></textarea>
	            
				<span class="error-message<?php if(empty($errors['job'])) echo ' hidden';?>" data-for="job"><?php
	                if(!empty($errors['job'])) echo $errors['job'];
                ?></span>
	            <input type="text" name="job" placeholder="Beroep/studierichting" class="formItem <?php if(!empty($errors['job'])) echo ' has-error'; ?>" value="<?php if(!empty($_POST['job'])) echo $_POST['job'];?>"/>
	            
	            <label for="image">Kies uw profielfoto</label>
				<span class="error-message<?php if(empty($errors['image'])) echo ' hidden';?>" data-for="image"><?php
	                if(!empty($errors['image'])) echo $errors['image'];
                ?></span>
	            <input type="file" name="image" class="formItem <?php if(!empty($errors['image'])) echo ' has-error'; ?>" />

	            <input type="submit" value="Registreer" class="registerBtn" />


	        </form>
		</section>
	</div>
</section>