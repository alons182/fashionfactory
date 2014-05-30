<?php namespace Fashion\Forms\Category;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator{

	protected $rules = [
		'name' => 'required'
		
	];
}