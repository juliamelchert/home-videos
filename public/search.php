<?php require_once("./components/header.php"); ?>

    <div class="page-title">
		<h1>Search</h1>
	</div>

    <form method="get" action="./handlers/search_handler.php">
        <div class="search-area">
            <input id="search-bar" type="text" name="search" placeholder="Search for videos by title, date, tags...">
            <button type="submit" id="btn-search"><img id="search-icon" src="./static/search-icon.png"></button>
        </div>
    </form>

<?php require_once("./components/footer.php"); ?>
