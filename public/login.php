<html>

    <title>Home Videos</title>
    <link rel="shortcut icon" type="image/png" href="./static/favicon.png">
    <link rel="stylesheet" href="./static/styles.css">

    <head>
        <!-- Empty navbar because the user is not logged in, but we want the formatting to remain the same -->
        <div id="navbar">
            <ol>
                <li id="easter-egg">Easter egg! :)</li>
            </ol>
        </div>
    </head>

    <body>
        <div id="main-content">

            <div class="page-title">
                <h1>Login</h1>
            </div>

            <div class="error-container <?php session_start(); echo (isset($_SESSION['errors'])) ? '' : 'hidden' ?>">
                <?php
                    if (isset($_SESSION['errors'])) {
                        foreach ($_SESSION['errors'] as $error) {
                            echo "<div class='error'>{$error}</div>";
                        }
                    }
                ?>
            </div>

            <form id="login-form" method="post" action="./handlers/login_handler.php">
                <div>
                    <label for="username">Username:</label>
                    <input required type="text" id="username" name="username" value="<?php echo isset($_SESSION['inputs']['username']) ? htmlspecialchars($_SESSION['inputs']['username']) : ""; ?>">
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input required type="password" id="password" name="password">
                </div>
                <input type="submit" value="Login">
            </form>

<?php require_once("./components/footer.php"); ?>