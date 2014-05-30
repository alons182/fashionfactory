<?php namespace Fashion\Forms\Product;

use Laracasts\Validation\FormValidator;

class EditForm extends FormValidator{

	protected $rules = [
		'name' => 'required',
		'description' => 'required',
		'price' => 'required'
		
	];
}