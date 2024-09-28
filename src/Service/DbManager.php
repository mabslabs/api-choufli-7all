<?php

namespace App\Service;

use Mabs\Container\Container;
use Mabs\ServiceAdapterInterface;

class DbManager implements ServiceAdapterInterface
{

    public function load(Container $container)
    {
        $container['pdo'] = function () {

            $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';
            $pdo = new \PDO($dsn, DB_USER, DB_PASSWORD);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $pdo;
        };

    }

    public function boot(Container $container)
    {
        // do nothing
    }

}
