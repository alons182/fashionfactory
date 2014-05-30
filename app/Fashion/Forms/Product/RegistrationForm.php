<?php namespace Fashion\Forms\Product;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator{

	protected $rules = [
		'name' => 'required',
		'description' => 'required',
		'price' => 'required',
		'categories' => 'required'
		
	];
}