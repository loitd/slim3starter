<?php
// Application middleware

/*
* Use a Route middleware instead of Application middleware. A route middleware will be only called if the Route matches the current HTTP 
* request, if you want middleware to be applicable only for Authentication related requests you can do something like this,
* 
* $app->get('/authentication_req', function ($req, $res, $args) {
*     echo ' Hello ';
* })->add(new ExampleMiddleware()); //This will be only applicable for this Route
*
*/

// e.g: $app->add(new \Slim\Csrf\Guard);

$app->add(new App\Middlewares\ValidationMiddleware($container));
$app->add(new App\Middlewares\OldInputMiddleware($container));

