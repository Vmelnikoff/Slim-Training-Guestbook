<?php


use App\Controllers\FormController;
use App\Controllers\HomeController;
use App\Controllers\ReviewController;
use App\Controllers\VoteController;

// Маршрут на главную страницу
$app->map(['GET', 'POST'], '/', HomeController::class . ':index');

$app->group('/form', function () {
    $this->get('', FormController::class . ':index');
    $this->post('', FormController::class . ':send');
});

$app->get('/review/{id}', ReviewController::class . ':index');

$app->get('/vote/{id}', VoteController::class . ':send');

