<?php
    session_start();

    $utente = $_SESSION['username'];
    $persona_da_seguire = $_GET['username'];

    $result = array();

    $conn = mysqli_connect('151.97.9.184', 'sicari_claudio', '7244067761', 'sicari_claudio');
    $query = "INSERT INTO follow VALUES('".$persona_da_seguire."', '".$utente."')";
    $res = mysqli_query($conn, $query);
    
    if ($res) {
        $result[0] = $persona_da_seguire;
        echo json_encode($result);
    }
?>