<html>

    <title>Home Videos</title>
    <link rel="shortcut icon" type="image/png" href="./static/favicon.png">
    <link rel="stylesheet" href="./static/styles.css">

    <head>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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