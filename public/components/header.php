<html>

    <title>Home Videos</title>
    <link rel="shortcut icon" type="image/png" href="./static/favicon.png">
    <link rel="stylesheet" href="./static/styles.css">

    <head>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Platypi:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
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