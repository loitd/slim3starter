<?php

namespace App\Middlewares;

/**
* 
*/
class ValidationMiddleware extends BaseMiddleware
{
	
	function __invoke($request, $response, $next)
	{
		# code...
		// var_dump('expression');
		if (!empty($_SESSION['errors'])) {
			# code...
			$this->c->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
			unset($_SESSION['errors']);
		}

		$response = $next($request, $response);
		return $response;
	}
}