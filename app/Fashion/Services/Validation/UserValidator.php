<?php namespace Fashion\Services\Validation;

class UserValidator extends Validator {

	static $rules = [
		'username' => 'required|unique:users',
		'email' => 'required|email|unique:users',
		'password' => 'required|confirmed',
		'user_type' => 'required'
		
	];


}

