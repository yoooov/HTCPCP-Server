<?php
require_once "../vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$app = new Silex\Application();

// create a log channel
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => 'php://stdout',
));

// admin controllers
$service = $app['controllers_factory'];

$service->match('/world', function () use ($app) {
    return (new CL\Controllers\HelloWorld($app['monolog']))->indexAction();
})->method('GET|BREW');

$app->mount("/hello", $service);
$app->run();
