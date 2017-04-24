<?php

require __DIR__ . '/production.php';

$app['api_url'] = 'http://192.168.150.100/';

/**
 * Postgres
 */
$app['db.options'] = array(
    'driver' => 'pdo_pgsql',
    'user' => 'urlshortener',
    'password' => 'urlshortener',
    'dbname' => 'urlshortener',
    'host' => 'postgres',
    'port' => 5432
);
