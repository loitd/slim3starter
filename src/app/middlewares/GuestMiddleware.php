<?php

namespace App\Middlewares;

/**
* 
*/
class GuestMiddleware extends BaseMiddleware
{
	
	function __invoke($request, $response, $next)
	{
		# code...
		if ($this->c->AuthController->isLogin()){
			// redirect to login page if user is not login
			return $response->withRedirect($this->c->router->pathFor('home'));
		}

		$response = $next($request, $response);
		return $response;
	}
}