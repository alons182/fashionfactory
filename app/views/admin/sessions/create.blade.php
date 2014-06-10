@extends('admin.layouts.layout')

@section('meta-title', 'Login')

@section('content')
<div class="starter-template">
	<div class="col-xs-12 col-sm-4">
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
			
			<a href="/password/remind">Forgot your password?</a>
			
		</div>
	</div>
	
</div>
@stop