@extends('admin.layouts.layout')

@section('meta-title', 'Login')

@section('content')
<div class="starter-template">
	<h1>Login</h1>
	{{ Form::open(['route'=>'sessions.store','']) }}

	
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
		{{ Form::submit('Log in',['class'=>'btn btn-primary'])}}
		
		{{ link_to_route('password_resets.create','Forgot your password?') }}

	</div>
	
</div>
@stop