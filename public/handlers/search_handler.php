<?php
    require_once("./dao.php");
    require_once('../../KLogger.php');
    $logger = new KLogger ("../../log.txt", KLogger::DEBUG);
    session_start();

    // Gather data from GET
    $search = $_GET['search'];

    // Validate data and collect any error messages
    $errors = [];
    $dao = new Dao();

    // Get all videos for given search query
    $allVideos = $dao->searchForStr($search);

    // Remove any duplicates
    $videoTitles = [];
    $i = 0;
    foreach ($allVideos as $video) {
        if (in_array($video['title'], $videoTitles)) {
            unset($allVideos[$i]);
        } else {
            $videoTitles[] = $video['title'];
        }
        $i++;
    }

    $_SESSION['search-videos'] = [];

    foreach ($allVideos as $video) {
        $url = $video['youtube_link'];
        $title = $video['title'];

        // Format is youtube.com/watch?v={video_id}
        if (preg_match('/youtube.com\/watch/', $url) == 1) {
            $pos = strpos($url, "v=") + 2;
            $video_id = substr($url, $pos, 11);

        // Format is youtu.be/{video_id}?
        } elseif (preg_match('/youtu.be\//', $url) == 1) {
            $pos = strpos($url, "youtu.be/") + 9;
            $video_id = substr($url, $pos, 11);
        
        // Video is a short, so format is https://youtube.com/shorts/{video_id}?si=fp74xcz--bWrXKMA
        } elseif (preg_match('/youtube.com\/shorts\//', $url) == 1) {
            $pos = strpos($url, "shorts/") + 7;
            $video_id = substr($url, $pos, 11);
        }

        $_SESSION['search-videos'][] = array("title"=>$title, "video_id"=>$video_id, "url"=>$url);
    }

    $_SESSION['inputs']['search'] = $search;

    header("Location: ../search.php");
    exit();

?>