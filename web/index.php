<?php
/**
 * index.php
 *
 * Configuration and setting up of the silex application.
 *
 * @author  Florian Petruschke <florian.petruschke@gmail.com>
 * @date    13.01.16  -  15:42
 * @version 1.0
 */

require_once '../vendor/autoload.php';
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;
use Silex\Application;

// Instantiation of Silex Application
$app = new Application();

/**
 * Defining project roots
 */
$app['serverRoot']  = "/emptyProject-Silex/web/";
$app['urlRoot']     = "/emptyProject-Silex/";

/*
 * Registering service provider for twig template engine
 */
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../app/MVC/View', // The path to the templates, which is in our case points to /var/www/templates
    'twig.options' => array('debug' => true)
));
$app['twig']->addExtension(new Twig_Extension_Debug());
$app['twig']->addGlobal('current_page_name', $app['routes']);


/*
 * Registering routes from yaml config
 */
$app['routes'] = $app->extend('routes', function(RouteCollection $routes, Application $app) {
    $configDirectories = array(__DIR__ . '/../app/config');
    $locator = new FileLocator($configDirectories);
    $loader = new YamlFileLoader($locator);
    $collection = $loader->load('routes.yml');
    $routes->addCollection($collection);
    return $routes;
});

/*
 * Registering entity Manager for yaml mapping
 */
$app['eM'] = function ($app) {
    $isDevMode = true;
    $config = \Doctrine\ORM\Tools\Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/../app/config/mapping"), $isDevMode);
    $path = 'emptyProjectSilex\\Model';
    $params = array(
        'driver' => 'pdo_mysql',
        'host'   => 'localhost',
        'user'   => 'silexAdmin',
        'password' => 'ADMIN',
        'dbname' => 'emptyProjectSilex',
        'collation' => 'utf-8',
        'charset' => 'utf8',
        'entities' => array(array(
            'type' => 'yaml',
            'path' => '../config/mapping',
            'namespace' => 'emptyProjectSilex\Model'
        )));
    $entityManager = \Doctrine\ORM\EntityManager::create($params, $config);
    return $entityManager;
};

$app['checkSession'] = function ($app) {
    session_start();
    if(!isset($_SESSION['user'])) {
        return $app['twig']->render(
            'auth/login.html.twig',
            array(
            )
        );
    } else {
        return $_SESSION['user'];
    }
};

$app['rerouteHome'] = function ($app) {
    if($app['checkSession']) {
        return $app->redirect($app['urlRoot'] . '/home');
    } else {
        return false;
    }
};

/*
 * Registering simple self written logController
 */
$app['log'] = new \emptyProjectSilex\Controller\Tools\logController(__DIR__ . '/../app/logs');

// for debugging purposes set to "true"
$app['debug'] = true;

// run Silex application with the above configuration
$app->run();