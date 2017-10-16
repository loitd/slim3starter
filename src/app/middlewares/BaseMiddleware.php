<?php

namespace App\Middlewares;

/**
* Base Middleware for extend all middleware
*/
class BaseMiddleware 
{
	protected $c;

	function __construct($container)
	{
		# code...
		$this->c = $container;
	}
}