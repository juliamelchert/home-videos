<?php
    session_start();
    $_SESSION['current-page'] = "search";
    header("Location: ../search.php");
    exit();
?>