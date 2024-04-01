<html>

    <title>Home Videos</title>
    <link rel="shortcut icon" type="image/png" href="./static/favicon.png">
    <link rel="stylesheet" href="./static/styles.css">

    <head>
        <?php
            require_once("nav.php");
            if (!isset($_SESSION['authenticated']) or !$_SESSION['authenticated']) {
                header("Location: ./login.php");
                exit();
            }
        ?>
    </head>

    <body>
        <div id="main-content">