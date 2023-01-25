<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        header("location: login.php");
    }
?>

<html>
    <head>
        <script src='search_people.js' defer></script>
        <link rel='stylesheet' href='search_people.css'>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;1,600;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@700&display=swap" rel="stylesheet">
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
            <form method="post" name="form_search_people">
            <div id='error' class='hidden'>
                    <p>
                    </p>
            </div>
                    <p id='input'>
                    <label>Cerca per username<input type="text" name="username"></label>
                    </p>
                    <p id='show'>
                    <label>&nbsp;<input type="submit" value="cerca"></label>
                    </p>
                    <p id='showall'>
                    <label><input id='tutto' type="button" value="show all" name='mostra_tutti'></label>
                    </p>
            </form>
            <div id="container"></div>
        </main>
    </body>
</html>