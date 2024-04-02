<header>
    <div id="navbar">
        <ol>
            <li><a class="link" href="./handlers/index_handler.php">Home</a></li>
            <li><a class="link" href="./handlers/browse_handler.php">Browse</a></li>
            <li><a class="link" href="search.php">Search</a></li>
            <?php
                session_start();
                if (isset($_SESSION['admin']) and $_SESSION['admin'] == 1) {
                    echo '<li><a class="link" href="upload.php">Upload</a></li>';
                }
            ?>
            <li id="profile-li">
                <a class="link" id="profile-link" href="profile.php">
                    <img id="profile-pic" src="./static/blank-pfp.png">
                    <span id="nav-username"><?php echo htmlspecialchars($_SESSION['username']);?></span>
                </a>
            </li>
        </ol>
    </div>
</header>