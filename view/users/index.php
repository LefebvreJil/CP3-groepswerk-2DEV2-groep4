<section class="home">
		<header class="titel">
			<h1><a href="index.php">Whiteboard</a></h1>
		</header>
		<div id="session_messages">
		    <?php if(!empty($_SESSION['info'])): ?><div class="success"><?php echo $_SESSION['info'];?></div><?php endif; ?>
		    <?php if(!empty($_SESSION['error'])): ?><div class="error"><?php echo $_SESSION['error'];?></div><?php endif; ?>
		<!--HIER EEN TRANSITIE PLAATSEN!-->

		<div <?php if(empty($_SESSION['info'])): ?>class="hidden"<?php endif; ?>><?php if(!empty($_SESSION['info'])):?> <p class="succes"><?php echo $_SESSION['info'];  ?></p><?php endif; ?> </div>
		</div>
	<div class="homeWrap">
		<section class="homeForm">
			<header>
				<h1>Login</h1>
			</header>
			<form id="loginForm" class="loginForm" action="index.php" method="post">
			<div>
				<span class="error-message<?php if(empty($errors['email'])) echo ' hidden';?>" 
				data-for="email"> 
				Gelieve je email in te vullen</span>

				<input type="email" 
				name="email" 
				placeholder="Email" 
				tabindex="1" 
				class="formItem <?php if(!empty($errors['email'])) echo ' has-error'; ?>" >
			</div>

			<div>
				<span class="error-message<?php if(empty($errors['password'])) echo ' hidden';?>" 
				data-for="password"> 
				Gelieve je wachtwoord in te vullen</span>

				<input type="password" 
				name="password" 
				placeholder="Password" 
				tabindex="2" 
				class="formItem <?php if(!empty($errors['password'])) echo ' has-error'; ?>" >
			</div>

			<div>
				<input type="submit" 
				value="Login" 
				tabindex="3"  
				class="loginBtn" />
			</div>
	            
	            
	            
	        </form>
		</section>
		<section class="registerHome">
			<header>
				<h1>Nieuw?</h1>
			</header>
			<a href="index.php?page=register" class="registerBtn">Registreer</a>
		</section>
	</div>
</section>