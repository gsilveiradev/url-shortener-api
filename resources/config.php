<?php

$app['api_url'] = getenv('API_URL');

$app['log.level'] = Monolog\Logger::ERROR;

/**
 * Postgres
 */
$app['db.options'] = array(
    'driver' => getenv('DB_DRIVER'),
    'user' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'dbname' => getenv('DB_DBNAME'),
    'host' => getenv('DB_HOST'),
    'port' => getenv('DB_PORT')
);
