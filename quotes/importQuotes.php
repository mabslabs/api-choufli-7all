<?php

require __DIR__.'/../config.php';
require __DIR__.'/../vendor/autoload.php';

$quotesDir = __DIR__.'/raw';
$actorsArray = [];
// Connexion to database and init script
try {

    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT actors_id, actors_slug FROM actors');

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $actorsArray[$row['actors_slug']] = $row['actors_id'];
    }

} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

// trancate table
$sql = 'TRUNCATE TABLE quotes';
$pdo->exec($sql);

// get all .txt files
$files = glob($quotesDir . '/*.txt');

foreach ($files as $file) {

    $slug = basename($file, '.txt');

    if (isset($actorsArray[$slug])) {
        $actorId = $actorsArray[$slug];

        $quotes = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($quotes as $quote) {

            $stmt = $pdo->prepare('INSERT INTO quotes (quotes_text, id_author) VALUES (:quote, :authorId)');
            $stmt->execute(['quote' => $quote, 'authorId' => $actorId]);
        }

        echo "Quotes imported for actor: $slug\n";
    } else {
        echo "No actor found for slug: $slug\n";
    }
}



