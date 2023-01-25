<?php

    session_start();

    if($_POST['selezione'] == 'openlibrary') {

        // Impostiamo l'url per la ricerca
        $url = "http://openlibrary.org/search.json?author=" .rawurlencode($_POST['barra_ricerca']);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        curl_close($curl);

        echo $result;
    }

    if($_POST['selezione'] == 'youtube') {

        $api_key = "AIzaSyBOgNen92SjXYXy5zAwPRfy9tA3RJobouE";
        $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=" .rawurlencode($_POST['barra_ricerca']). 
        "&type=video&maxResults=12&key=" .$api_key;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        curl_close($curl);

        echo $result;
    }
?>