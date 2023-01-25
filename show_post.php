<?php

    session_start();

    $selezione1 = array();
    $selezione2 = array();
    $selezione3 = array();
    $result_finale = array();

    $conn = mysqli_connect('151.97.9.184', 'sicari_claudio', '7244067761', 'sicari_claudio');

    $query1 = " SELECT utente_seguito FROM follow where follower = '".$_SESSION['username']."'";
    $res1 = mysqli_query($conn, $query1);
    while($row1 = mysqli_fetch_array($res1)) {
        $selezione1[] = $row1;
    }

    $query2 = "SELECT * FROM post";
    $res2 = mysqli_query($conn, $query2);
    while($row2 = mysqli_fetch_array($res2)) {
        $selezione2[] = $row2;
    }

    $query3 = "SELECT * FROM mipiace where messo_da = '".$_SESSION['username']."'";
    $res3 = mysqli_query($conn, $query3);
    while($row3 = mysqli_fetch_array($res3)) {
        $selezione3[] = $row3;
    }

    for ($i = 0, $k = 0; $i < count($selezione2); $i++, $k++) {

        $result_finale[$k]['id'] = $selezione2[$i]['id'];
        $result_finale[$k]['titolo'] = $selezione2[$i]['titolo'];
        $result_finale[$k]['contenuto'] = $selezione2[$i]['contenuto'];
        $result_finale[$k]['creato_da'] = $selezione2[$i]['creato_da'];
        $result_finale[$k]['type'] = $selezione2[$i]['type'];
        $result_finale[$k]['immagine'] = $selezione2[$i]['immagine'];
        $result_finale[$k]['likes'] = $selezione2[$i]['likes'];
        $result_finale[$k]['title'] = $selezione2[$i]['title'];
        $result_finale[$k]['author'] = $selezione2[$i]['author'];
        $result_finale[$k]['data_post'] = $selezione2[$i]['data_post'];
        $result_finale[$k]['liked'] = 0;

        for($y = 0; $y < count($selezione3); $y++) {
            if($selezione3[$y]['post'] == $selezione2[$i]['id']) {
                $result_finale[$k]['liked'] = 1;
                break;
            }
            else {
                $result_finale[$k]['liked'] = 0;
            }
        }

        for($j = 0; $j < count($selezione1); $j++) {
            
           if(strcmp($selezione2[$i]['creato_da'], $selezione1[$j]['utente_seguito']) == 0) {
               
                $result_finale[$k]['followed'] = 1;
                break;
           }
           else {
                $result_finale[$k]['followed'] = 0;
           }
        }
    }

    if (mysqli_num_rows($res1) > 0) {
        echo json_encode($result_finale);
    }
?>