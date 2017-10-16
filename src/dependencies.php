<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Register Twig View helper
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig(
    	$c->get('settings')['renderer']['template_path'], 
    	// ['cache' => $c->get('settings')['renderer']['cache_path']]
    	['cache' => false]
    );
    
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    // $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $basePath)); //-> you must not using this fucking init as the docs or the fuction is_current_path() in twig wont work.
    $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $c['request']->getUri()));

    return $view;
};

// database
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->get('settings')['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function($c) use ($capsule){
	return $capsule;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// csrf
// Only apply csrf for some route not API
$container['csrf'] = function($c){
    return new \Slim\Csrf\Guard;
};

$app->add($container->get('csrf')); //turn on global csrf

//validator
$container['validator'] = function($c){
    return new App\Validations\Validator();
};


// controllers
$container['AuthController'] = function($c){
	return new App\Controllers\AuthController($c);
};

// view 
// add to view global must be here not in controllers
$container->view->getEnvironment()->addGlobal('auth', $container['AuthController']->getAuth());