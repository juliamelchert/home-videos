<?php

    // Testing if the data is uploaded correctly and I know how to access it:
    // $myfile = fopen("./search_log.txt", "w") or die("Unable to open file!");
    // fwrite($myfile, $_GET['search']);
    // fclose($myfile);

    header("Location: ../search.php");
    exit();

?>