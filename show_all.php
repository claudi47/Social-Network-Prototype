<?php
    session_start();

    $conn = mysqli_connect('151.97.9.184', 'sicari_claudio', '7244067761', 'sicari_claudio');

    //Lo inizializiamo come array perché il risultato che vogliamo ha una riga, ma più colonne
    $selezione = array();
    $row2 = array();
    $result_array = array();

    $res = mysqli_query($conn, "SELECT username, immagine FROM utente WHERE username <> '".$_SESSION['username']."'");

    // Abbiamo richiamato tutti gli utente che l'utente della sessione segue
    $res2 = mysqli_query($conn, "SELECT utente_seguito FROM follow WHERE follower = '".$_SESSION['username']."' AND
    utente_seguito <> '".$_SESSION['username']."'");

    while($row = mysqli_fetch_array($res)) {
        $selezione[] = $row;
    }

    while($row1 = mysqli_fetch_array($res2)) {
        $row2[] = $row1;
    }

    $k = 0;
    for ($i = 0; $i < count($selezione); $i++, $k++) {
        // Abbiamo creato un array in cui username ed immagine ci sono di base
        $result_array[$k]['username'] = $selezione[$i]['username'];
        $result_array[$k]['immagine'] = $selezione[$i]['immagine'];

        $result_array[$k]['followed'] = 0;

        for($j = 0; $j < count($row2); $j++) {
            // compariamo se l'username dell'utente seguito corrisponde a quello attuale del primo for
           if(strcmp($selezione[$i]['username'], $row2[$j]['utente_seguito']) == 0) {
               // aggiungiamo un campo followed per indicare che effettivamente è seguito. In JS ci permette di evitare una chiamata asincrona
               $result_array[$k]['followed'] = 1;
           }
        }
    }

    if (mysqli_num_rows($res) > 0) {
        echo json_encode($result_array);
    }
?>