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

        $fileContent = getGithubRawFileContent('https://raw.githubusercontent.com/mabslabs/api-choufli-7all/main/quotes/raw/'.$slug.'.txt');

        $quotes = array_filter(array_map('trim', explode("\n", (string) $fileContent)));

        foreach ($quotes as $quote) {

            $stmt = $pdo->prepare('INSERT INTO quotes (quotes_text, id_author) VALUES (:quote, :authorId)');
            $stmt->execute(['quote' => $quote, 'authorId' => $actorId]);
        }

        echo "Quotes imported for actor: $slug\n";
    } else {
        echo "No actor found for slug: $slug\n";
    }
}

/**
 * Read file from github
 *
 * @param [type] $url
 * @return void
 */
function getGithubRawFileContent($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  // suit les redirections (utile pour GitHub)
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);           // limite de temps
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0'); // GitHub exige souvent un User-Agent

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($response === false) {
        die('Erreur cURL : ' . $error);
    }

    if ($httpCode !== 200) {
        die('Fichier inaccessible, code HTTP : ' . $httpCode);
    }

    return $response;
}



