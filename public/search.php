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

    <div class=video-container-col>
		<?php
            if (isset($_SESSION['search-videos'])) {
                foreach ($_SESSION['search-videos'] as $video) {
                    $video_id = $video['video_id'];
                    $title = $video['title'];
                    $url = $video['url'];
                    echo "<div class='video-component-col'>";
                    echo "<a href=" . htmlspecialchars($url) . "><img class='thumbnail' src='http://img.youtube.com/vi/" . htmlspecialchars($video_id) . "/hqdefault.jpg' title='" . htmlspecialchars($title) . "' alt='YouTube Thumbnail' /></a>";
                    echo "<p>" . htmlspecialchars($title) . "</p>";
                    echo "</div>";
                }
            }
		?>
	</div>

<?php require_once("./components/footer.php"); ?>
