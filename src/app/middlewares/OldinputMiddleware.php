<?php

namespace App\Middlewares;

/**
* 
*/
class OldInputMiddleware extends BaseMiddleware
{
	
	function __invoke($request, $response, $next)
	{
		# code...
		// var_dump('expression');
		if (!empty($_SESSION['oldinput'])) {
			# code...
			$this->c->view->getEnvironment()->addGlobal('oldinput', $_SESSION['oldinput']);
		}
		$_SESSION['oldinput'] = $request->getParams();

		$response = $next($request, $response);
		return $response;
	}
}