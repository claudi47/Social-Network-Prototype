<?php

    session_start();
    $conn = mysqli_connect('151.97.9.184', 'sicari_claudio', '7244067761', 'sicari_claudio');
    $query = "SELECT username FROM utente WHERE username = '".$_GET['username']."'";
    $res = mysqli_query($conn, $query);

    if (mysqli_num_rows($res) > 0) {
        $ret = 1;
        echo $ret;
    }

    else {
        $ret = 0;
        echo $ret;
    }
?>