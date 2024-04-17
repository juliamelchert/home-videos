<?php
    require_once("./dao.php");
    require_once('../../KLogger.php');
    $logger = new KLogger ("../../log.txt", KLogger::DEBUG);
    session_start();

    // Gather data from POST
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate data and collect any error messages
    $errors = [];
    $dao = new Dao();

    // Validate a username and password were entered
    if ($username == "") {
        $logger->LogWarn("login_handler: data validation - no username entered");
        $errors[] = "Please enter a username.";
    }

    if ($password == "") {
        $logger->LogWarn("login_handler: data validation - no password entered");
        $errors[] = "Please enter a password.";
    }

    if ($dao->checkLogin($username, $password)) {
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;

        // Check if admin now that we know username/password is valid
        $_SESSION['admin'] = $dao->checkAdmin($username);
        unset($_SESSION['errors']);

        header("Location: ./index_handler.php");
        exit();
    } else {
        if ($username != "" and $password != "") {
            $logger->LogInfo("login_handler: incorrect username or password");
            $errors[] = "Incorrect username or password.";
        }

        $_SESSION['errors'] = $errors;
        $logger->LogWarn("login_handler: errors were present, passing the following errors to the session: " . print_r($_SESSION['errors'], 1));
        $_SESSION['inputs'] = $_POST;

        header("Location: ../login.php");
        exit();
    }
?>