<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', \App\Controller\StudentController::class . ':index');
$app->get('/students/create', \App\Controller\StudentController::class . ':create');
$app->post('/students/create', \App\Controller\StudentController::class . ':store');
$app->get('/students/edit/{id}', \App\Controller\StudentController::class . ':edit');
$app->post('/students/edit/{id}', \App\Controller\StudentController::class . ':update');
$app->get('/students/delete/{id}', \App\Controller\StudentController::class . ':delete');
