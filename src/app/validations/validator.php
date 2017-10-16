<?php

namespace App\Validations;
use Respect\Validation\Exceptions\NestedValidationException;
/**
* 
*/
class Validator
{
	protected $errors;

	function validate($request, array $rules)
	{
		# code...
		// Add custome rules
		// v::with('App\\Rules\\');
		// now validate
		foreach ($rules as $field => $rule) {
			# code...
			try{
				$rule->setName(ucfirst($field))->assert($request->getParam($field));
			} catch(NestedValidationException $e) {
				$this->errors[$field] = $e->getMessages();
			}
			
		}

		$_SESSION['errors'] = $this->errors;

		// dd($this->errors);
		return $this;
	}

	function failed(){
		return !empty($this->errors);
	}
}