<?php

session_start();

require '../vendor/autoload.php';

use DI\ContainerBuilder;
use League\Plates\Engine;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    Engine::class => function() {
        return new Engine('../app/views');
    },

]); //указываем исключения из правил
$container = $containerBuilder->build();

$templates = new League\Plates\Engine('../app/views');

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

    $r->addRoute('GET', '/', ['App\controller\PageController', 'questionNumber']);
    $r->addRoute('GET', '/questionNumber', ['App\controller\PageController', 'questionNumber']);
    $r->addRoute('GET', '/resultPage', ['App\controller\PageController', 'resultPage']);
    $r->addRoute('GET', '/homePage', ['App\controller\PageController', 'homePage']);

    $r->addRoute('GET', '/clearSession', ['App\controller\PageController', 'clearSession']);

});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo $templates->render('error/404');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo $templates->render('error/405');
        break;
    case FastRoute\Dispatcher::FOUND:

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        $container->call($handler, [$vars]);

        break;
}
