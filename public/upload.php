<?php require_once("./html/components/header.php"); ?>

	<div class="page-title">
		<h1>Upload a Video</h1>
	</div>

    <form method="post" action="../../video_handler.php">
      <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title">
      </div>
      <div>
        <label for="link">YouTube URL:</label>
        <input type="text" id="link" name="link">
      </div>

      <div>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date">
      </div>

      <div id="tags-label">Tags:</div>
      <div class="form-tags">
        <?php
            $tags = array("Jonah", "Sami", "Julia", "Football", "Theater", "Gymnastics");

            for ($i = 0; $i < count($tags); $i++) {
                echo "<div class='tag-component'>";
                echo "<input type='checkbox' id='{$tags[$i]}' name='{$tags[$i]}'>";
                echo "<label for='{$tags[$i]}'>" . ucfirst($tags[$i]) . "</label>";
                echo "</div>";
            }

        ?>

      </div>

      <input type="submit" value="Submit">
   </form>

<?php require_once("./html/components/footer.php"); ?>
