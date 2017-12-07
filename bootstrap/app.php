<?php

require_once __DIR__ . '/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => $_ENV['APP_ERRORS'] === 'true',
        'debug' => $_ENV['APP_DEBUG'] === 'true',

        'views' => [
            'cache' => $_ENV['TWIG_CACHE'] === 'true' ? __DIR__ . '/../storage/cache/views' : false,
            'debug' => $_ENV['TWIG_DEBUG'] === 'true' ?: false,
        ],

        'db' => [
            'driver' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'database' => $_ENV['DB_DATABASE'],
            'charset' => $_ENV['DB_CHARSET'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
        ],
    ],
]);

$container = $app->getContainer();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../views', [
        'cache' => $container->settings['views']['cache'],
        'debug' => $container->settings['views']['debug'],
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    ($_ENV['TWIG_DEBUG'] === 'true') ? $view->addExtension(new Twig_Extension_Debug()) : false;

    return $view;
};

$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        $container->view->render($response, 'errors/404.twig');
        return $response->withStatus(404);
    };
};

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($c) use ($capsule) {
    return $capsule;
};

$container['review'] = function ($c) {
    return new \App\Models\Review();
};



require_once __DIR__ . '/../routes/web.php';