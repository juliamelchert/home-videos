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

        // Format is www.youtube.com/watch?v={video_id}
        if (preg_match('/www.youtube.com\//', $url) == 1) {
            $pos = strpos($url, "v=") + 2;
            $video_id = substr($url, $pos);

        // Format is youtu.be/{video_id}?
        } elseif (preg_match('/youtu.be\//', $url) == 1) {
            $posStart = strpos($url, "youtu.be/") + 9;
            $posEnd = strpos($url, "?");
            $video_id = substr($url, $posStart, ($posEnd - $posStart));
        }

        $_SESSION['videos'][] = array("title"=>$title, "video_id"=>$video_id, "url"=>$url);
    }

    header("Location: ../browse.php");
    exit();

?>