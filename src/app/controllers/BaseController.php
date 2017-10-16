<?php

namespace App\Controllers;

// to add custome rules folder for controllers
use Respect\Validation\Validator as v;

/**
* 
*/
class BaseController 
{
	protected $c;

	function __construct($container)
	{
		# code...
		$this->c = $container;
		v::with('App\\Validations\\Rules'); // add rules folder for controllers
	}
}