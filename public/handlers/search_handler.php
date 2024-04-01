<?php
    require_once("./dao.php");
    require_once('../../KLogger.php');
    $logger = new KLogger ("../../log.txt", KLogger::DEBUG);
    session_start();

    // Gather data from POST
    $search = $_POST['search'];

    // Validate data and collect any error messages
    $errors = [];
    $dao = new Dao();

    // TODO: Implement search functionality
    

    header("Location: ../search.php");
    exit();

?>