<?php require_once("./components/header.php"); ?>

    <div class="page-title">
		<h1>Profile Information</h1>
	</div>

    <div class="user-info">
        <p>Username: <?php echo $_SESSION['username']; ?></p>
    </div>

    <div class="logout">
        <a class="link" href="./handlers/logout_handler.php"><button type="button">Logout</button></a>
    </div>

<?php require_once("./components/footer.php"); ?>
