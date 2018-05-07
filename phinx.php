<?php

use Dotenv\Dotenv;

require __DIR__.'/vendor/autoload.php';

(new Dotenv(__DIR__))->load();

$config = require __DIR__ . '/config/database.php';

return [
    'paths'         => [
        'migrations' => __DIR__.'/database',
    ],
    'environments'  => [
        'default_migration_table' => 'phinxlog',
        'default_database'        => 'development',
        'development'              => [
            'adapter' => $config['connections'][$config['default']]['driver'],
            'host'    => $config['connections'][$config['default']]['host'],
            'port'    => $config['connections'][$config['default']]['port'],
            'name'    => $config['connections'][$config['default']]['database'],
            'user'    => $config['connections'][$config['default']]['username'],
            'pass'    => $config['connections'][$config['default']]['password'],
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation'
];