<?php namespace Fashion\Forms\User;

use Laracasts\Validation\FormValidator;

class EditForm extends FormValidator{

	protected $rules = [
		'username' => 'required',
		'email' => 'required|email',
		'password' => 'confirmed',
		'user_type' => 'required'
	];
}