<?php

namespace App\Validations\Rules;
use App\Models\User;

// to create custome rules for controllers
use Respect\Validation\Rules\AbstractRule;

/**
* 
*/
class EmailUnique extends AbstractRule
{
	
	function validate($input)
	{
		# code...
		// dd('hihihihihh');
		return (User::where('email', '=', $input)->count() === 0);
	}
}