<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


include('db.inc.php');
$themes = getThemes();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Leren lezen</title>
</head>

<body>
    <main>
        <h1>Welk thema wil je spelen?</h1>
        <br>
        <form method="post" action="play.php">
            <?php
            foreach ($themes as $nr => $theme):
            ?>
                <input type="submit" name="theme" id="<?= $theme['idthemes'] ?>" value="<?= $theme['themeName'] ?>">
            <?php endforeach; ?>
            <input type="submit" name="theme" id="0" value="mix">

        </form>



        <a href="admin.php">_____</a>
    </main>
</body>

</html>