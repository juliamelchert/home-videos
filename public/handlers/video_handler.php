<?php
    require_once("./dao.php");
    require_once('../../KLogger.php');
    $logger = new KLogger ("../../log.txt", KLogger::DEBUG);
    session_start();

    // Gather data from POST
    $title = $_POST['title'];
    $url = $_POST['url'];
    $date = $_POST['date'];

    if (isset($_POST['tags'])) {
        $tags = $_POST['tags'];
    } else {
        $tags = [];
    }
    
    // Validate data and collect any error messages
    $errors = [];
    $dao = new Dao();

    // Validate title exists, is less than 128 chars long, and is unique
    if ($title == "") {
        $logger->LogWarn("video_handler: data validation - no title entered");
        $errors[] = "Please enter a title for the video.";
    } elseif (strlen($title) > 128) {
        $logger->LogWarn("video_handler: data validation - title is too long (" . strlen($title) . " chars long, max 128)");
        $errors[] = "Please enter a shorter title for the video.";
    }

    if (!$dao->checkTitleIsUnique($title)) {
        $logger->LogWarn("video_handler: data validation - title " . $title . " is not unique");
        $errors[] = "Please enter a title that has not been used already.";
    }

    // Validate URL exists, is less than 512 chars long, and is a YouTube URL
    if ($url == "") {
        $logger->LogWarn("video_handler: data validation - no URL entered");
        $errors[] = "Please enter a URL for the video.";
    } elseif (strlen($url) > 512) {
        $logger->LogWarn("video_handler: data validation - URL is too long (" . strlen($url) . " chars long, max 512)");
        $errors[] = "Please enter a shorter URL for the video (consider using a URL shortener).";
    }

    if (preg_match('/www.youtube.com\//', $url) == 0 and preg_match('/youtu.be\//', $url) == 0) {
        $logger->LogWarn("video_handler: data validation - not a YouTube URL");
        $errors[] = "Please enter a YouTube URL.";
    }

    // Validate date exists, is on or before current date, only contains numbers and /, -, or ., and is a valid date
    if ($date == "") {
        $logger->LogWarn("video_handler: data validation - no date entered");
        $errors[] = "Please enter a date for the video.";
    }

    if (strtotime($date) > time()) {
        $logger->LogWarn("video_handler: data validation - date after today (" . $date . ") entered");
        $errors[] = "Please enter a date on or before today.";
    }

    function explodeFindSeparator($dateStr, $format) {
        if ($format == "mdy" or $format == "dmy") {
            $sep = $dateStr[2];
            return explode($sep, $dateStr, 3);
        } elseif ($format == "ymd" or $format == "ydm") {
            $sep = $dateStr[4];
            return explode($sep, $dateStr, 3);
        } else {
            return array();
        }
    }

    // Checks for (month or day)(/ or -)(month or day)(/ or -)(year) with a regex
    if (preg_match("/^[0-9]{2}(\/|-)[0-9]{2}(\/|-)[0-9]{4}$/", $date) == 1) {
        $explodedDate = explodeFindSeparator($date, "mdy");

        // If it's not an actual day but matches the format, add appropriate error message
        if (!checkdate($explodedDate[0], $explodedDate[1], $explodedDate[2])) {
            $logger->LogWarn("video_handler: data validation - not a day or month/day in reverse order (mdy/dmy)");
            $errors[] = "This date does not exist. Please make sure the entered date is in the format (MM/DD/YYYY).";
        }

    // Checks for (year)(/ or -)(month or day)(/ or -)(month or day) with a regex
    } elseif (preg_match("/^[0-9]{4}(\/|-)[0-9]{2}(\/|-)[0-9]{2}$/", $date) == 1) {
        $explodedDate = explodeFindSeparator($date, "ymd");

        // If it's not an actual day but matches the format, add appropriate error message
        if (!checkdate($explodedDate[1], $explodedDate[2], $explodedDate[0])) {
            $logger->LogWarn("video_handler: data validation - not a day or month/day in reverse order (ymd)");
            $errors[] = "This date does not exist. Please make sure the entered date is in the format (MM/DD/YYYY).";
        }

    // Date doesn't match either of the allowed date formats, so error
    } else {
        if ($date != "") {
            $logger->LogWarn("video_handler: data validation - invalid date format");
            $errors[] = "Please enter a date with the correct format (MM/DD/YYYY).";
        }
    }

    // Note: tag existence is validated in the DAO

    // If there are any error messages, add to session and exit
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $logger->LogWarn("video_handler: errors were present, passing the following errors to the session: " . print_r($_SESSION['errors'], 1));
        $_SESSION['inputs'] = $_POST;
        $logger->LogInfo("video_handler: errors were present, passing the following vals as inputs: " . print_r($_SESSION['inputs'], 1));
        header("Location: ../upload.php");
        exit();
    }

    // Add data to database with DAO
    $dao->createVideo($title, $url, $date, $tags);
    $_SESSION['inputs'] = [];

    // Display success message

    header("Location: ../upload.php");
    exit();

?>