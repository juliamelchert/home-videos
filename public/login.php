<html>

    <title>Home Videos</title>
    <link rel="shortcut icon" type="image/png" href="./static/favicon.png">
    <link rel="stylesheet" href="./static/styles.css">

    <head>
        <!-- Empty navbar because the user is not logged in, but we want the formatting to remain the same -->
        <div id="navbar">
        </div>
    </head>

    <body>
        <div id="main-content">

            <div class="error-container">
                <?php
                    session_start();
                    if (isset($_SESSION['errors'])) {
                        foreach ($_SESSION['errors'] as $error) {
                            echo "<div class='error'>{$error}</div>";
                        }
                        unset($_SESSION['errors']);
                    }
                ?>
            </div>

            <div class="page-title">
                <h1>Login</h1>
            </div>

            <form id="login-form" method="post" action="./handlers/login_handler.php">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <input type="submit" value="Login">
            </form>

<?php require_once("./components/footer.php"); ?>