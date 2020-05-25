<?php
require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

use app\controllers\ExampleController;
use app\controllers\HomeController;
use app\kernel\Routes;
use database\Database;

$database = new Database();
$database->init();

$router = new Routes();

$router->on('POST', '', function () {
    return ExampleController::index();
});

$router->on('GET', 'user/:id', function () {
    echo 'página de usuário';
});

$router->on('GET', 'api/user', function () {
    $home = new HomeController();
    $home->login();
});

$router->boot();