<?php namespace Fashion\Forms\Category;

use Laracasts\Validation\FormValidator;

class EditForm extends FormValidator{

	protected $rules = [
		'name' => 'required'
		
	];
}