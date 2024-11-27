<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include('db.inc.php');

// print '<pre>';
// print_r($_POST);
// print '</pre>';

// nieuw woord en opties ophalen
$theme = @$_POST['theme'] ?: 'mix';


$fullArray = getWords($theme);
$oldWord = null;
$chosenOption = "";
$total = @$_POST["total"] ?: 0;
$correct = @$_POST["correct"] ?: 0;
$theme = @$_POST["theme"] ?: 0;




if (isset($_POST["option"])) {
    $total++;
    $chosenOption = $_POST["option"];
} //is er een option gegeven?

if (isset($_POST["solution"])) {
    $oldWord = $_POST['solution'];
} //is er een woord gegeven?

$numOptions = min(count($fullArray), 4);

$options = array_rand($fullArray, $numOptions);
$optionsComplete = [];
foreach ($options as $option) {
    $optionsComplete[] = $fullArray[$option];
}



shuffle($optionsComplete);
// andere optie van de vier als woord kiezen indien gelijk aan vorige woord
do {
    $newWord = $optionsComplete[array_rand($optionsComplete)];
} while ($newWord['solution'] == $oldWord);

if (count($optionsComplete) > 0) {
    $newWord = $optionsComplete[array_rand($optionsComplete)];
}

// $errors = [];
// $success = null;


// if (!in_array($options, [])) {
//     $errors[] = 'Kies het juiste antwoord';
// }

// if ($chosenOption == $oldWord) {
//     $success = 'Goed antwoord!';
// }

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="play.css">
    <title>Leren Lezen</title>
    <style>

    </style>
</head>

<body>
    <main>
        <h1>Wat ben ik?</h1>

        <img src="<?= $newWord['url']; ?>" alt="">
        <br>
        <?php if (isset($_POST['option'])):
            if ($chosenOption === $oldWord):
                $correct++; ?>
                <div class="correct">Goed gedaan!!!</div>
            <?php else: ?>
                <div class="false">Fout antwoord!!!</div>
        <?php endif;
        endif; ?>
        <br>
        <form method="post" action="play.php">
            <input type="hidden" name="total" id="total" value="<?= $total ?>">
            <input type="hidden" name="correct" id="correct" value="<?= $correct ?>">
            <input type="hidden" name="solution" id="solution" value="<?= $newWord['solution'] ?>">
            <input type="hidden" name="theme" id="theme" value="<?= $theme ?>">
            <?php
            foreach ($optionsComplete as $nr => $option):
            ?>
                <input type="submit" name="option" id="<?= $option['idsolutions'] ?>" value="<?= $option['solution'] ?>">
            <?php endforeach; ?>

        </form>
        <br>
        <?php if (isset($_POST['option'])): ?>
            <div>Jouw score is : <?= $correct ?> / <?= $total ?></div>
        <?php endif; ?>
    </main>
</body>

</html>