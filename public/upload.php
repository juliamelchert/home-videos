<?php require_once("./components/header.php"); ?>

	<div class="page-title">
		<h1>Upload a Video</h1>
	</div>

    <div class="error-container">
        <?php
            if (isset($_SESSION['errors'])) {
                foreach ($_SESSION['errors'] as $error) {
                    echo "<div class='error'>{$error}</div>";
                }
                unset($_SESSION['errors']);
            }
        ?>
    </div>

        <form method="post" action="./handlers/video_handler.php">
            <div>
                <label for="title">Title<span class="required">*</span></label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="url">YouTube URL<span class="required">*</span></label>
                <input type="text" id="url" name="url" required>
            </div>

            <div>
                <label for="date">Date<span class="required">*</span></label>
                <input type="date" id="date" name="date" required>
            </div>

            <div id="tags-label">Tags:</div>
            <div class="form-tags">
                <?php
                    /* TODO: Change below array to grab tags from db instead */
                    $tags = array("Jonah", "Sami", "Julia", "Football", "Theater", "Gymnastics");

                    for ($i = 0; $i < count($tags); $i++) {
                            echo "<div class='tag-component'>";
                            echo "<input type='checkbox' id='{$tags[$i]}' name='tags[]' value='"  . ucfirst($tags[$i]) . "'>";
                            echo "<label for='{$tags[$i]}'>" . ucfirst($tags[$i]) . "</label>";
                            echo "</div>";
                    }

                ?>
            </div>

            <input type="submit" value="Submit">
     </form>

    <!-- Change to a hovering tool tip later -->
    <div>
        <span class="required">*</span> = required field
    </div>

<?php require_once("./components/footer.php"); ?>
