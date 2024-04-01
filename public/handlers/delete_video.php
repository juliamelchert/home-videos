<?php
    require_once("./dao.php");
    require_once('../../KLogger.php');
    $logger = new KLogger ("../../log.txt", KLogger::DEBUG);
    session_start();

    // Gather data from GET
    $title = $_GET['title'];

    $dao = new Dao();
    $dao->deleteVideoFromTitle($title);

    header("Location: ./browse_handler.php");
    exit();
?>