<?php

// DIC configuration
$container = $app->getContainer();

// View renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Services and repositories
$container[\App\Repositories\Contract\StudentRepository::class] = function () {
    return new \App\Repositories\StudentMemoryRepository(
        new \App\Repositories\StudentEloquentRepository()
    );
};

$container[\App\Services\StudentService::class] = function ($container) {
    return new \App\Services\StudentService(
        $container[\App\Repositories\Contract\StudentRepository::class]
    );
};

$config = require __DIR__.'/../config/database.php';

// Database configuration
$manager = new \Illuminate\Database\Capsule\Manager();
$manager->addConnection($config['connections'][$config['default']]);
$manager->setAsGlobal();
$manager->bootEloquent();
