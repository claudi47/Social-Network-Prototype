<?php

    // Avvia la sessione
    session_start();
    // Verifica se l'utente è loggato
    if(!isset($_SESSION['username']))
    {
        // Vai alla login
        header("Location: login.php");
        exit;
    }

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel='stylesheet' href='home.css'>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;1,600;1,900&display=swap" rel="stylesheet">
        <script src='home.js' defer></script>
    </head>
    <body>
        <main>
            <nav>
                <p id='user'> <?php echo "Ciao, ", $_SESSION["username"]; ?> </p>
                <p id='home'><a href='home.php'>Home</a></p>
                <p id='post'><a href='create_post.php'>Nuovo Post</a></p>
                <p id='cerca'><a href='search_people.php'>Cerca persone</a></p>
                <p id='ciao'><a href='logout.php'>Logout</a></p>
            </nav>
            <div id='contenitore'></div>
        </main>
            <div id= 'modal' class = 'hidden'></div>
    </body>
</html>