<?php
    require_once("./dao.php");
    require_once('../../KLogger.php');
    $logger = new KLogger ("../../log.txt", KLogger::DEBUG);
    session_start();

    $dao = new Dao();
    $allVideos = $dao->getVideos();

    $_SESSION['videos'] = [];

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

        $_SESSION['videos'][] = array("title"=>$title, "video_id"=>$video_id, "url"=>$url);
    }

    $_SESSION['current-page'] = "browse";
    header("Location: ../browse.php");
    exit();

?>