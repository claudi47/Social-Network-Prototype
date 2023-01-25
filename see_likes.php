<?php

    session_start();

    $result = array();

    $conn = mysqli_connect('151.97.9.184', 'sicari_claudio', '7244067761', 'sicari_claudio');
    $res = mysqli_query($conn, "SELECT messo_da FROM mipiace where post = '".$_GET['id']."'");
    while ($row = mysqli_fetch_array($res)) {
        $result[] = $row;
    }

        echo json_encode($result);
?>