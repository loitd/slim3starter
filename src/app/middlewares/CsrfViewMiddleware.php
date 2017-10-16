<?php

namespace App\Middlewares;

/**
* 
*/
class CsrfViewMiddleware extends BaseMiddleware
{
	
	function __invoke($request, $response, $next)
	{
		# code...
		// CSRF token name and value
	    $nameKey = $this->c->csrf->getTokenNameKey();
	    $valueKey = $this->c->csrf->getTokenValueKey();
	    $name = $request->getAttribute($nameKey);
	    $value = $request->getAttribute($valueKey);

	    // $tokenArray = [
	    //     $nameKey => $name,
	    //     $valueKey => $value
	    // ];

	    // var_dump($tokenArray);

		$this->c->view->getEnvironment()->addGlobal('csrfv', [
			'field' => '<input type="hidden" name="'. $nameKey .'" value="'. $name .'">
			<input type="hidden" name="'. $valueKey .'" value="'. $value .'">',
		]);
		
		$response = $next($request, $response);
		return $response;
	}
}