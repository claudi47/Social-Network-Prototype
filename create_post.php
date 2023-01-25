<?php

    session_start();

    if(!isset($_SESSION['username']))
    {
        // Vai alla login
        header("Location: login.php");
        exit;
    }

    if(isset($_POST['img']) && isset($_POST['title']) && isset($_POST['author'])) {
        $conn = mysqli_connect('151.97.9.184', 'sicari_claudio', '7244067761', 'sicari_claudio');
        $query1 = "SELECT COUNT(id) FROM post";
        $result = mysqli_query($conn, $query1);

        $row = mysqli_fetch_row($result);
        $conta = $row[0];
        $time = time();
        $date = date("Y-h-d H:i:s", $time);

        $query2 = "INSERT INTO post VALUES ($conta+1, '".$_POST['titolo_post']."', '".$_POST['contenuto_post']."', '".$_SESSION['username']."', 
                                            '".$_POST['tipo']."', '".$_POST['img']."', 0, '".$_POST['title']."', '".$_POST['author']."'
                                            , '$date')";
        $res = mysqli_query($conn, $query2);

        if($res) {
            echo("Post creato con successo");
            header("Location: home.php");
        }
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <script src='create_post.js' defer></script>
        <link rel='stylesheet' href='create_post.css'>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;1,600;1,900&display=swap" rel="stylesheet">
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
            <div id="form_iniziale">
                <form name="search" method='post'>
                    <p>Scegli un'API:</p>
                    <select id='select' name='selezione'>
                        <option value='openlibrary'> OpenLibrary </option>
                        <option value='youtube'> YouTube </option>
                    </select>
                    <p>Ricerca qualcosa:</p>
                    <p id='text'>
                        <input type='text' name='barra_ricerca'>
                    </p>
                    <p id='button'>
                        <input type='submit' value='cerca'>
                    </p>
                </form>
            </div>
            <div id="principale"></div>
        </main>
        <div class="hidden">
            <form name="create_post" method='post'>
                <input type='hidden' name='img'>
                <input type='hidden' name='title'>
                <input type='hidden' name='author'>
                <input type='hidden' name='tipo'>
                <p>
                    Titolo: <input type='text' name='titolo_post'>
                </p>
                <p>
                    <textarea name='contenuto_post'></textarea>
                </p>
                <p>
                    <input type='submit' value='pubblica'>
                </p>
                <p>
                    <input id='chiudi' type='button' value='chiudi'>
                </p>
            </form>
        </div>
    </body>
</html>