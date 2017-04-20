<?php

require __DIR__ . '/production.php';

/**
 * Postgres
 */
$app['db.options'] = array(
    "driver" => "pdo_pgsql",
    "user" => "urlshortener",
    "password" => "urlshortener",
    "dbname" => "urlshortener",
    "host" => "localhost",
    "port" => 5432
);
