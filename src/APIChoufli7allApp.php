<?php
namespace App;
use Mabs\Application;

class APIChoufli7allApp extends Application
{
    public function getAdapters()
    {
        return array(
            new \Mabs\Adapter\SessionServiceAdapter(),
            new \App\Service\DbManager,
        );
    }
}