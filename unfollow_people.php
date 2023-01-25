<?php
    session_start();

    $utente = $_SESSION['username'];
    $persona_da_unfolloware = $_GET['username'];

    $result = array();

    $conn = mysqli_connect('151.97.9.184', 'sicari_claudio', '7244067761', 'sicari_claudio');
    $query = "DELETE FROM follow WHERE utente_seguito = '".$persona_da_unfolloware."' AND follower = '".$utente."'";
    $res = mysqli_query($conn, $query);

    if ($res) {
        $result[0] = $persona_da_unfolloware;
        echo json_encode($result);
    }
?>