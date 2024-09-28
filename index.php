<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';

use  \Symfony\Component\HttpFoundation\JsonResponse;

$app = new App\APIChoufli7allApp();
$container = $app->getContainer();

$app->get('random', function () use ($container) {
    $quote = [];
    $stmt = $container['pdo']->query('SELECT COUNT(*) AS count FROM quotes');
    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    if ($count > 0) {
        // Get a random quote
        $randomIndex = rand(0, $count - 1);
        $stmt = $container['pdo']->prepare('SELECT quotes.quotes_text, actors.actors_name FROM quotes JOIN actors ON quotes.id_author = actors.actors_id LIMIT 1 OFFSET :offset');
        $stmt->bindValue(':offset', $randomIndex, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $quote = [
            'quote' => $row['quotes_text'],
            'actor' => $row['actors_name'],
        ];
    }

    return new JsonResponse($quote);

})->run();