<?php
    session_start();
    $_SESSION['current-page'] = "upload";
    header("Location: ../upload.php");
    exit();
?>