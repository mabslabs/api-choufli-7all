<?php

require_once __DIR__.'/vendor/autoload.php';

use  \Symfony\Component\HttpFoundation\JsonResponse;

$app = new Mabs\Application();

$app->get('random', function () {

	$data = [
		'quote' => 'المريض عندي، ما يخرجش قبل ما يتحسن',
		'auhtor' => 'سليمان الأبيض'
	];
	
    return new JsonResponse($data);

})->run();