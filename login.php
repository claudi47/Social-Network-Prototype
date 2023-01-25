<?php

    session_start();
    
    if(isset($_POST["username"]) && isset($_POST["password"]))
    {
        // Connetti al database
        $conn = mysqli_connect('151.97.9.184', 'sicari_claudio', '7244067761', 'sicari_claudio');
        // Cerca utenti con quelle credenziali
        $query = "SELECT * FROM utente WHERE username = '".$_POST["username"]."' AND password = '".$_POST["password"]."'";
        $res = mysqli_query($conn, $query);
        // Verifica la correttezza delle credenziali
        if(mysqli_num_rows($res) > 0)
        {
            // Imposta la variabile di sessione
            $_SESSION["username"] = $_POST["username"];

            if(isset($_POST['cookie'])) {
                setcookie("username", $_POST['username'], time() + 43200);
                setcookie("password", $_POST['password'], time() + 43200);
            }
            // Vai alla pagina home.php
            header("Location: home.php");
            exit;
        }

        else
        {
            $errore = true;
        }
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;1,600;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@700&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='login.css'>
        <script src='login.js' defer></script>
    </head>

    <body>
        <main>
            <p id='scritta'> MOUNTAIN CHALET <p>
            <div>
                <form name="login" method="post">
                    <div id='error' class='hidden'>
                        <p><?php 
                            if(isset($errore)) {
                                echo "Credenziali errate!";
                            }
                            ?>
                        </p>
                    </div>
                    <p id='user'>
                        <label>Username <input type="text" name="username" 
                        value = <?php if(isset($_COOKIE['username'])) { echo $_COOKIE['username'];} ?>> </label>
                    </p>
                    <p id='passw'>
                        <label>Password <input type="password" name="password"
                        value = <?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password'];} ?>></label>
                    </p>
                    <p id= 'checkbox'>
                        <label>Ricordami<input type='checkbox' name='cookie'>
                    </p>
                    <p id='submit'>
                        <label>&nbsp;<input type='submit'></label>
                    </p>
                    <p id='registrato'>
                        <bold>Non sei ancora registrato? </bold><a href = 'http://151.97.9.184/sicari_claudio/Homework1/HMW1/signup.php'>Registrati</a>
                    </p>
                </form>
            </div>
        </main>
    </body>
</html>