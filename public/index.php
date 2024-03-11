<?php require_once("./components/header.php"); ?>

	<div class="page-title">
		<h1>Recently Uploaded</h1>
	</div>

	<div class=video-container>
		<?php
			$numOfVideos = 3;
			$videoTitles = array("Gymnastics Meet", "Skit Night", "Swimming");

			for ($i = 0; $i < $numOfVideos; $i++) {
				echo "<p>{$videoTitles[$i]}</p>";
				include("./components/video.php");
			}
		?>
	</div>

<?php require_once("./components/footer.php"); ?>
