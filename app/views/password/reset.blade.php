@extends('admin.layouts.layout')

@section('meta-title', 'Reset Your Password')

@section('content')
<div class="starter-template">
	<h1>Reset Your Password Now</h1>
	{{ Form::open() }}
		{{ Form::hidden('token', $token) }}
	
	<div class="form-group">
		{{ Form::label('email','Email:')}}
		{{ Form::email('email',null,['class'=>'form-control','required'=>'required'])}}
		{{ errors_for('email',$errors) }}
	</div>

	<div class="form-group">
		{{ Form::label('password','Password:')}}
		{{ Form::password('password',['class'=>'form-control','required'=>'required'])}}
		{{ errors_for('password',$errors) }}

	</div>
	
	<div class="form-group">
		{{ Form::label('password_confirmation','Password confirmation:')}}
		{{ Form::password('password_confirmation',['class'=>'form-control','required'=>'required'])}}

	</div>
	
	<div class="form-group">
		{{ Form::submit('Create New Password',['class'=>'btn btn-primary'])}}

	</div>

	
	
</div>
@stop