@extends('admin.layouts.layout')

@section('content')
<div class="starter-template">
	<h1>Product Creation</h1>
	
	{{ Form::open(['route'=>'admin.products.store','files'=> true]) }}

	<div class="col-xs-12 col-sm-6">

		<div class="form-group">
			{{ Form::label('name','Name:')}}
			{{ Form::text('name',null,['class'=>'form-control','required'=>'required'])}}
			{{ errors_for('name',$errors) }}
			

		</div>
		<div class="form-group">
			{{ Form::label('categories','Categories:')}}
			{{ Form::select('categories[]', $categories, null , ['multiple' => 'multiple','class'=>'form-control','required'=>'required']) }}
			{{ errors_for('categories',$errors) }}

		</div>
		<div class="form-group">
			{{ Form::label('description','Description:')}}
			{{ Form::textarea('description',null,['class'=>'form-control','required'=>'required']) }}
			{{ errors_for('description',$errors) }}
		</div>

		<div class="form-group">
			{{ Form::label('price','Price:')}}
			{{ Form::text('price',null,['class'=>'form-control','required'=>'required'])}}
			{{ errors_for('price',$errors) }}

		</div>

		<div class="form-group">
			{{ Form::label('published','Published:')}}
			{{ Form::select('published', ['1' => 'Yes', '0' => 'No'], null,['class'=>'form-control','required'=>'required']) }}
			{{ errors_for('published',$errors) }}

		</div>
		<div class="form-group">
			{{ Form::submit('Create Product',['class'=>'btn btn-primary'])}}
			{{ link_to_route('admin.products.index', 'Cancel', null, ['class'=>'btn btn-default'])}}

		</div>
		
		
	</div>
	<div class="col-xs-6 col-md-6">
		<div class="form-group">
			{{ Form::label('image','Main image:')}}
			{{ Form::file('image') }}
			{{ errors_for('image',$errors) }}
		</div>
		<div class="form-group">
		 	<fieldset>
		        <legend>Gallery</legend>
		        <div id="inputs_photos">
                      
		        	<input class="inputbox btn btn-info" type="button" name="new_photo"  value="Nueva Foto"  id="add_input_photo"/><i class="glyphicon glyphicon-plus-sign"></i>
		        
		        </div>
	        </fieldset>
	    </div>

	 </div>
	 
	{{ Form::close() }}
</div>
@stop
