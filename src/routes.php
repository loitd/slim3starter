<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get ('/',		 	'AuthController:gethome', ['current_uri' => 'home'])->setname('home');

$app->group('', function(){
	$this->get ('/login', 	'AuthController:getlogin', ['current_uri' => 'login'])
		 ->setname('auth.login')
		 ->add(new App\Middlewares\CsrfViewMiddleware($this->getcontainer())); 

	$this->post('/login', 	'AuthController:postlogin');

	$this->get ('/register',	'AuthController:getregister', ['current_uri' => 'register'])
		 ->setname('auth.register')
		 ->add(new App\Middlewares\CsrfViewMiddleware($this->getcontainer())); 

	$this->post('/register',	'AuthController:postregister');

})->add(new App\Middlewares\GuestMiddleware($container));


$app->group('', function(){
	$this->get ('/logout',	'AuthController:getlogout')->setname('auth.logout');	
})->add(new App\Middlewares\AuthMiddleware($container));






