<?php

// CONNECTIE MAKEN MET DE DB
function connectToDB()
{
    // CONNECTIE CREDENTIALS
    $db_host = '127.0.0.1';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'lerenlezen';
    $db_port = 8889;

    try {
        $db = new PDO('mysql:host=' . $db_host . '; port=' . $db_port . '; dbname=' . $db_db, $db_user, $db_password);
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        die();
    }
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    return $db;
}


// HAAL ALLE WOORDEN UIT DE DB
function getWords($theme = 0): array
{
    if ($theme != 'mix') {
        $sql = "SELECT solutions.*, themes.themeName
        FROM solutions
        LEFT JOIN themes
        ON solutions.theme = themes.idthemes WHERE themes.themeName = :theme;";
        $stmt = connectToDB()->prepare($sql);
        $stmt->execute([
            ':theme' => $theme
        ]);
    } else {
        $sql = "SELECT solutions.*, themes.themeName
        FROM solutions
        LEFT JOIN themes
        ON solutions.theme = themes.idthemes;";
        $stmt = connectToDB()->prepare($sql);
        $stmt->execute();
    }

    // $stmt = connectToDB()->prepare($sql);
    // $stmt->execute([
    //     ':theme' => $theme
    // ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// HAAL ALLE THEMES UIT DE DB
function getThemes(): array
{
    $sql = "SELECT *
    FROM themes;";

    $stmt = connectToDB()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
