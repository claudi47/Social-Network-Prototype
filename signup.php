<?php
    session_start();

    if(isset($_POST["username"]) && isset($_POST["password"]) && "" != trim($_POST['username'])){
        $target_dir = "uploads/";
        // basename($path, $suffix)
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        // pathinfo mi restituisce le info sul pth sottoforma di array
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Vediamo se l'immagine è veramente un'immagine
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 10000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Immagine caricata con successo!";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        if ($uploadOk == 1) {
            /* Verifica l'accesso
            if(isset($_SESSION["username"]))
            {
                // Vai alla home
                header("Location: home.php");
                exit;
            } */

            // Verifica l'esistenza di dati POST
                // Connetti al database
            $conn = mysqli_connect('151.97.9.184', 'sicari_claudio', '7244067761', 'sicari_claudio');
                // Inserisci utenti con quelle credenziali
            $query = "INSERT INTO utente VALUES ('".$_POST["email"]."', '".$_POST["username"]."', '".$_POST["name"]."', '".$_POST["surname"]."',
            '".$_POST["password"]."', '$target_file')";
            $res = mysqli_query($conn, $query);

            $query2 = "INSERT INTO follow VALUES('".$_POST['username']."', '".$_POST['username']."')";
            $res2 = mysqli_query($conn, $query2);
            if ($res) {
                header('Location: home.php');
            }
        }
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;1,600;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@700&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='signup.css'>
        <script src='signup.js' defer></script>
    </head>

    <body>
        <main>
            <p id='scritta'> IN OUR FAMILY </p>
            <div>
                <form name="signup" method="post" enctype="multipart/form-data">
                    <div id='error' class='hidden'>
                        <p>
                        </p>
                    </div>
                    <p id='nome'>
                        <label>Nome <input type='text' name='name'></label>
                    </p>
                    <p id='cognome'>
                        <label>Cognome <input type='text' name='surname'></label>
                    </p>
                    <p id='email'>
                        <label>Email <input type='email' name='email'></label>
                    </p>
                    <p id='user'>
                        <label>Username <input type='text' name='username'></label>
                    </p>
                    <p id='passw'>
                        <label>Password <input type='password' name='password'></label>
                    </p>
                    <p id = 'conf_passw'>
                        <label>Conferma Password <input type='password' name='confirm_password'></label>
                    </p>
                    <p id= 'img'>
                        <label>Immagine di profilo <input type='file' name='fileToUpload'></label>
                    </p>
                    <p id='submit'>
                        <label>&nbsp;<input type='submit'></label>
                    </p>
                    <p id='login'>
                        <bold>Già registrato? </bold><a href = 'http://151.97.9.184/sicari_claudio/Homework1/HMW1/login.php'>Login</a>
                    </p>
                </form>
            </div>
            <p id='scritta2'> WE ARE GLAD TO SEE YOU </p>   
        </main>
    </body>
</html>