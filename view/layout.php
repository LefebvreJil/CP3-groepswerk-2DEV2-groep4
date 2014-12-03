<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Whiteboard</title>
	<link rel="stylesheet" href="css/screen.css">
</head>
<body>
	<div id="session_messages">
	    <?php if(!empty($_SESSION['info'])): ?><div class="success"><?php echo $_SESSION['info'];?></div><?php endif; ?>
	    <?php if(!empty($_SESSION['error'])): ?><div class="error"><?php echo $_SESSION['error'];?></div><?php endif; ?>
	</div>
	<?php echo $content; ?>
	
	<script src="js/vendor/jquery.min.js"></script>
	<script src="js/vendor/modernizr.min.js"></script>
	<script src="js_dist/script.dist.js"></script>
</body>
</html>