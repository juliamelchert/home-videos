<?php require_once("./components/header.php"); ?>

	<div class="page-title">
		<h1>Recently Uploaded</h1>
	</div>

	<div class=video-container>
		<?php
			foreach ($_SESSION['recent-videos'] as $video) {
				$video_id = $video['video_id'];
				$title = $video['title'];
				$url = $video['url'];
				echo "<div class='video-component'><p>" . htmlspecialchars($title) . "</p>";
				echo "<a href=";
				echo (substr($url, 0, 8) == "https://") ? "" : "https://";
				echo htmlspecialchars($url) . "><img class='thumbnail' src='http://img.youtube.com/vi/" . htmlspecialchars($video_id) . "/hqdefault.jpg' title='" . htmlspecialchars($title) . "' alt='YouTube Thumbnail' /></a></div>";
			}
		?>
	</div>

<?php require_once("./components/footer.php"); ?>
