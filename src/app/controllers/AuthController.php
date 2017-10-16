<?php

namespace App\Controllers;
use App\Models\User;
use Respect\Validation\Validator as v;

/**
* 
*/

class AuthController extends BaseController 
{
	public function gethome($request, $response){
		return $this->c->view->render($response, 'index.twig');
	}
	
	public function getlogin($request, $response, $args)
	{
		# code...
		// $user = User::where('id', '1')->first();
		// dd($user->email);
		return $this->c->view->render($response, 'login.twig');
	}

	// check if user is logged in
	public function isLogin(){
		return isset($_SESSION['uid']);
	}

	// get logged in user
	public function getUser(){
		if (isset($_SESSION['uid'])){
			return User::find($_SESSION['uid']);	
		}	
	}

	// get auth to pass to view
	public function getAuth(){
		$auth = [
			'id' 		=> isset($_SESSION['uid']) ? $_SESSION['uid'] : null,
			'check'		=> $this->isLogin(),
			'user'		=> $this->getUser(),
		];

		// dd($auth);
		return $auth;
	}

	// login attempt
	public function attempt($email, $password){
		// check if email exists
		$user = User::where('email', '=', $email)->first();
		if (!$user){
			return False;
		} elseif (password_verify($password, $user->password)) {
			// set session id
			$_SESSION['uid'] = $user->id;
			// return to function
			return True;
		} else {
			return False;
		}
		
	}

	public function postlogin($request, $response, $args){

		$valid = $this->c->validator->validate($request, [
			'email'		=> v::notEmpty()->noWhitespace()->email(),
			'password' 	=> v::notEmpty()->alpha(),
		]);

		if ($valid->failed()) {
			# code...
			return $response->withRedirect($this->c->router->pathFor('auth.login'));
		}

		// dd($request->getParams());
		$email 		= $request->getParam('email');
		$password 	= $request->getParam('password');

		if (!$this->attempt($email, $password)){
			return $response->withRedirect($this->c->router->pathFor('auth.login')); 
		} else {
			return $response->withRedirect($this->c->router->pathFor('home'));
		}

	}

	public function getregister($request, $response, $args){
		return $this->c->view->render($response, 'register.twig');
	}

	public function postregister($request, $response, $args){

		$valid = $this->c->validator->validate($request, [
			'name' 		=> v::notEmpty()->noWhitespace(),
			'email'		=> v::notEmpty()->noWhitespace()->email()->emailUnique(),
			'password' 	=> v::notEmpty()->alpha(),
		]);

		if ($valid->failed()) {
			# code...
			return $response->withRedirect($this->c->router->pathFor('auth.register'));
		}

		$user = User::create([
			'name' 		=> $request->getParam('name'),
			'email' 	=> $request->getParam('email'),
			'password'	=> password_hash($request->getParam('password'),PASSWORD_DEFAULT),
		]);

		return $response->withRedirect($this->c->router->pathFor('home'));
	}

	public function getlogout($request, $response, $args){
		unset($_SESSION['uid']);
		return $response->withRedirect($this->c->router->pathFor('home'));
	}
}