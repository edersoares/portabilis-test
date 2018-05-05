<?php

use Dotenv\Dotenv;

require __DIR__.'/vendor/autoload.php';

(new Dotenv(__DIR__))->load();

return [
    'paths'         => [
        'migrations' => __DIR__.'/database',
    ],
    'environments'  => [
        'default_migration_table' => 'phinxlog',
        'default_database'        => 'development',
        'development'              => [
            'adapter' => 'pgsql',
            'host'    => getenv('DB_HOST'),
            'name'    => getenv('DB_NAME'),
            'user'    => getenv('DB_USER'),
            'pass'    => getenv('DB_PASS'),
            'port'    => 5432,
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation'
];