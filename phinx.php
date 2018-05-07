<?php

use Dotenv\Dotenv;

require __DIR__.'/vendor/autoload.php';

(new Dotenv(__DIR__))->load();

$config = require __DIR__ . '/config/database.php';

return [
    'paths'         => [
        'migrations' => $config['migrations'] ?? null,
    ],
    'environments'  => [
        'default_migration_table' => 'phinxlog',
        'default_database'        => 'development',
        'development'              => [
            'adapter' => $config['connections'][$config['default']]['driver'] ?? null,
            'host'    => $config['connections'][$config['default']]['host'] ?? null,
            'port'    => $config['connections'][$config['default']]['port'] ?? null,
            'name'    => $config['connections'][$config['default']]['database'] ?? null,
            'user'    => $config['connections'][$config['default']]['username'] ?? null,
            'pass'    => $config['connections'][$config['default']]['password'] ?? null,
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation'
];