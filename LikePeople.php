<?php
    session_start();

    $ret = array();

    $conn = mysqli_connect('151.97.9.184', 'sicari_claudio', '7244067761', 'sicari_claudio');

    $query1 = "INSERT INTO mipiace VALUES ('".$_SESSION['username']."', '".$_GET['id']."')";
    $res1 = mysqli_query($conn, $query1);

    $query2 = "SELECT likes FROM post where id = '".$_GET['id']."'";
    $res2 = mysqli_query($conn, $query2);
    $row = mysqli_fetch_row($res2);

    if($res1) {
        $ret[0]['id_post'] = $_GET['id'];
        $ret[0]['num_likes'] = $row[0];
        echo json_encode($ret);
    }
?>