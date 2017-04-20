<?php

require_once __DIR__.'/vendor/autoload.php';

define("ROOT_PATH", __DIR__);

$app = new Silex\Application();

require __DIR__ . '/resources/config/production.php';
require __DIR__ . '/src/app.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($app['orm.em']);