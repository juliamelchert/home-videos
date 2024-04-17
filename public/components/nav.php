<header>
    <div id="navbar">
        <ol>
            <?php session_start(); ?>
            <li class="nav-item <?php echo (isset($_SESSION['current-page']) and $_SESSION['current-page'] == "home") ? "current-page" : ""?>"><a class="link" href="./handlers/index_handler.php">Home</a></li>
            <li class="nav-item <?php echo (isset($_SESSION['current-page']) and $_SESSION['current-page'] == "browse") ? "current-page" : ""?>"><a class="link" href="./handlers/browse_handler.php">Browse</a></li>
            <li class="nav-item <?php echo (isset($_SESSION['current-page']) and $_SESSION['current-page'] == "search") ? "current-page" : ""?>"><a class="link" href="./handlers/set_current_search.php">Search</a></li>
            <?php
                if (isset($_SESSION['admin']) and $_SESSION['admin'] == 1) {
                    echo '<li class="nav-item ';
                    echo (isset($_SESSION['current-page']) and $_SESSION['current-page'] == "upload") ? "current-page" : "";
                    echo '"><a class="link" href="./handlers/set_current_upload.php">Upload</a></li>';
                }
            ?>
            <li class="nav-item <?php echo (isset($_SESSION['current-page']) and $_SESSION['current-page'] == "profile") ? "current-page" : ""?>" id="profile-li">
                <a class="link" id="profile-link" href="./handlers/set_current_profile.php">
                    <img id="profile-pic" src="./static/blank-pfp.png">
                    <span id="nav-username"><?php echo htmlspecialchars($_SESSION['username']);?></span>
                </a>
            </li>
        </ol>
    </div>
</header>