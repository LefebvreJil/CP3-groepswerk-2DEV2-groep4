<div id="session_messages">
    <?php if(!empty($_SESSION['info'])): ?><div class="success"><?php echo $_SESSION['info'];?></div><?php endif; ?>
    <?php if(!empty($_SESSION['error'])): ?><div class="error"><?php echo $_SESSION['error'];?></div><?php endif; ?>
</div>
<h1>Hallo</h1>