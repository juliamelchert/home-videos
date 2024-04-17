<?php require_once("./components/header.php"); ?>

    <div class="page-title">
		<h1>Browse All Videos</h1>
	</div>

	<div class=video-container-grid>
		<?php
			foreach ($_SESSION['videos'] as $video) {
				$video_id = $video['video_id'];
				$title = $video['title'];
				$url = $video['url'];
				echo "<div class='video-component'>
						<div class='video-header'>
							<span>" . htmlspecialchars($title) . "</span>";
				if (isset($_SESSION['admin']) and $_SESSION['admin'] == 1) {
					echo "<a href='./handlers/delete_video.php?title=" . htmlspecialchars($title) . "' title='Delete'><button class='btn-delete'>X</button></a>";
				}
				echo "</div>";
				echo "<a href=";
				echo (substr($url, 0, 8) == "https://") ? "" : "https://";
				echo htmlspecialchars($url) . "><img class='thumbnail' src='http://img.youtube.com/vi/" . htmlspecialchars($video_id) . "/hqdefault.jpg' title='" . htmlspecialchars($title) . "' alt='YouTube Thumbnail' /></a></div>";
			}
		?>
	</div>

<?php require_once("./components/footer.php"); ?>