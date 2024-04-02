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
                <input required type="text" id="title" name="title" value="<?php echo isset($_SESSION['inputs']['title']) ? htmlspecialchars($_SESSION['inputs']['title']) : ""; ?>">
            </div>
            <div>
                <label for="url">YouTube URL<span class="required">*</span></label>
                <input required type="text" id="url" name="url" value="<?php echo isset($_SESSION['inputs']['url']) ? htmlspecialchars($_SESSION['inputs']['url']) : ""; ?>">
            </div>

            <div>
                <label for="date">Date<span class="required">*</span></label>
                <input required type="date" id="date" name="date" value="<?php echo isset($_SESSION['inputs']['date']) ? htmlspecialchars($_SESSION['inputs']['date']) : ""; ?>">
            </div>

            <div id="tags-label">Tags:</div>
            <div class="form-tags">
                <?php
                    $tags = array("Jonah", "Sami", "Julia", "Football", "Theater", "Gymnastics");

                    for ($i = 0; $i < count($tags); $i++) {
                        echo "<div class='tag-component'>";
                        echo "<input type='checkbox' id='{$tags[$i]}' name='tags[]' value='"  . ucfirst($tags[$i]) . "' ";
                        if (isset($_SESSION['inputs']['tags'])) {
                            echo in_array($tags[$i], $_SESSION['inputs']['tags']) ? "checked" : "";
                        }
                        echo ">";
                        echo "<label for='{$tags[$i]}'>" . ucfirst($tags[$i]) . "</label>";
                        echo "</div>";
                    }

                ?>
            </div>

            <input type="submit" value="Submit">
     </form>

    <!-- TODO: Change to a hovering tool tip later -->
    <div>
        <span class="required">*</span> = required field
    </div>

<?php require_once("./components/footer.php"); ?>
