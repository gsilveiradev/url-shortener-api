<?php

date_default_timezone_set('America/Sao_Paulo');

require_once __DIR__.'/../vendor/autoload.php';

define('ROOT_PATH', __DIR__ . '/..');

$app = new Silex\Application();

$dotenv = new Dotenv\Dotenv(ROOT_PATH, 'config.env');
$dotenv->load();

require __DIR__ . '/../resources/config.php';

require __DIR__ . '/../src/app.php';

$app['http_cache']->run();
