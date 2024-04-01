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
							<span>{$title}</span>";
				if (isset($_SESSION['admin']) and $_SESSION['admin'] == 1) {
					echo "<button id='btn-delete'><a href='./handlers/delete_video.php?title={$title}'>X</a></button>";
				}
				echo "</div>";
				echo "<a href={$url}><img class='thumbnail' src='http://img.youtube.com/vi/{$video_id}/hqdefault.jpg' title='{$title}' alt='YouTube Thumbnail' /></a></div>";
			}
		?>
	</div>

<?php require_once("./components/footer.php"); ?>