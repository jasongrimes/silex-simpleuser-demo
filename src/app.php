<?php

use Silex\Application;
use Silex\Provider;

//
// Application setup
//

$app = new Application();
$app->register(new Provider\DoctrineServiceProvider());
$app->register(new Provider\SecurityServiceProvider());
$app->register(new Provider\RememberMeServiceProvider());
$app->register(new Provider\SessionServiceProvider());
$app->register(new Provider\ServiceControllerServiceProvider());
$app->register(new Provider\UrlGeneratorServiceProvider());
$app->register(new Provider\TwigServiceProvider());
$app->register(new Provider\SwiftmailerServiceProvider());

// Register the SimpleUser service provider.
$simpleUserProvider = new SimpleUser\UserServiceProvider();
$app->register($simpleUserProvider);

//
// Controllers
//

$app->mount('/user', $simpleUserProvider);
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig', array());
});

//
// Configuration
//
// Normally I'd put this stuff in config/prod.php and include it from index.php,
// but for the sake of demonstration it's easier to see it all here in one file.
//

$app['twig.path'] = array(__DIR__.'/../templates');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');

$app['security.firewalls'] = array(
    /*
    // Ensure that the login page is accessible to all
    'login' => array(
        'pattern' => '^/user/login$',
    ),*/
    'secured_area' => array(
        'pattern' => '^.*$',
        'anonymous' => true,
        'remember_me' => array(),
        'form' => array(
            'login_path' => '/user/login',
            'check_path' => '/user/login_check',
        ),
        'logout' => array(
            'logout_path' => '/user/logout',
        ),
        'users' => $app->share(function($app) { return $app['user.manager']; }),
    ),
);

$app['user.options'] = array(
    'templates' => array(
        'layout' => 'layout.twig',
        'view' => 'view.twig',
    ),
    'mailer' => array('enabled' => false),
    'editCustomFields' => array('twitterUsername' => 'Twitter username'),
    'userClass' => '\Demo\User',
);


// Note that this db config is here for example only.
// It actually gets overwritten by configuration in config/local.php,
// which I don't commit to version control.
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'host' => 'localhost',
    'dbname' => 'mydbname',
    'user' => 'mydbuser',
    'password' => 'mydbpassword',
);


// Local environment configuration that doesn't get committed to version control.
require __DIR__ . '/../config/local.php';

return $app;
