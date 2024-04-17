<?php
    session_start();
    $_SESSION['current-page'] = "profile";
    header("Location: ../profile.php");
    exit();
?>