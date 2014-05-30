@extends('admin.layouts.layout')

@section('content')
<div class="starter-template">
	<h1>Register</h1>
	{{ Form::open(['route'=>'user_register.store','']) }}
	<div class="col-xs-12 col-sm-6">
		<div class="form-group">
			{{ Form::label('username','Username:')}}
			{{ Form::text('username',null,['class'=>'form-control','required'=>'required'])}}
			{{ errors_for('username',$errors) }}
			

		</div>
		<div class="form-group">
			{{ Form::label('email','Email:')}}
			{{ Form::email('email',null,['class'=>'form-control','required'=>'required'])}}
			{{ errors_for('email',$errors) }}
		</div>
		<div class="form-group">
			{{ Form::label('user_type','Tipo:')}}
			{{ Form::select('user_type',['admin'=>'Administrator','basic'=>'Regular'],null,['class'=>'form-control','required'=>'required'])}}
			{{ errors_for('user_type',$errors) }}
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
			{{ Form::submit('Create User',['class'=>'btn btn-primary'])}}
			{{ link_to_route('admin.users.index', 'Cancel', null, ['class'=>'btn btn-default'])}}
			

		</div>
	</div>
	{{ Form::close() }}
</div>
@stop