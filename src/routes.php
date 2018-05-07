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

$app->get('/api/students', \App\Controller\Api\StudentController::class . ':index');
$app->post('/api/students', \App\Controller\Api\StudentController::class . ':create');
$app->get('/api/students/{id}', \App\Controller\Api\StudentController::class . ':browse');
$app->patch('/api/students/{id}', \App\Controller\Api\StudentController::class . ':update');
$app->delete('/api/students/{id}', \App\Controller\Api\StudentController::class . ':delete');
