@extends('admin.layouts.layout')

@section('meta-title', 'Reset Your Password')

@section('content')
<div class="starter-template">
	<h1>Reset Your Password</h1>
	{{ Form::open() }}

	
	<div class="form-group">
		{{ Form::label('email','Email:')}}
		{{ Form::email('email',null,['class'=>'form-control','required'=>'required'])}}
		{{ errors_for('email',$errors) }}
	</div>
	
	
	
	<div class="form-group">
		{{ Form::submit('Reset',['class'=>'btn btn-primary'])}}

	</div>

		
</div>
@stop
