<?php

namespace App\Validations\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

/**
* 
*/
class EmailUniqueException extends ValidationException
{
	
	public static $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'Email is already taken.',
		],
	];
}