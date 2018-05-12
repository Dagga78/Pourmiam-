<?php
// DIC configuration
use Doctrine\DBAL\Configuration as DoctrineConfiguration;
use Doctrine\DBAL\DriverManager as DoctrineManager;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Doctrine DB
$container['db'] = function ($c) {

    $dbSettings = $c->get('settings')['db'];
    $config = new DoctrineConfiguration();

    $connectionParams = array(
        'user' => $dbSettings['DB_USER'],
        'password' => $dbSettings['DB_PASSWORD'],
        'host' => $dbSettings['DB_HOST'],
        'dbname' => $dbSettings['DB_NAME'],
        'path' => $dbSettings['DB_PATH'],
        'driver' => $dbSettings['DB_DRIVER'],
        'charset' => 'utf8',
    );

    $dbal = DoctrineManager::getConnection($connectionParams, $config);
    $dbal->setFetchMode(\PDO::FETCH_ASSOC);
    return $dbal;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Customer Error Handler
$container["errorHandler"] = function ($container) {
    return new \Handlers\ApiError($container["logger"]);
};
