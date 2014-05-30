@extends('admin.layouts.layout')

@section('content')
<div class="starter-template">
	<h1>Category Editing</h1>
	
	{{ Form::model($category, ['method' => 'put', 'route' => ['admin.categories.update', $category->id],'files'=> true ]) }}
	<div class="col-xs-12 col-sm-6">
	
		<div class="form-group">
			{{ Form::label('name','Name:')}}
			{{ Form::text('name',null,['class'=>'form-control','required'=>'required'])}}
			{{ errors_for('name',$errors) }}
			

		</div>
		<div class="form-group">
			{{ Form::label('description','Description:')}}
			{{ Form::textarea('description',null,['class'=>'form-control','required'=>'required']) }}
			{{ errors_for('description',$errors) }}
		</div>

		<div class="form-group">
			{{ Form::label('parent_id','Parent Category:')}}
			{{ Form::select('parent_id', $options, null , ['class'=>'form-control','required'=>'required']) }}
			{{ errors_for('parent_id',$errors) }}

		</div>
		
		
	    <div class="form-group">
			{{ Form::label('view_type','View type:')}}
			{{ Form::select('view_type', ['default' => 'default','portrait' => 'portrait','image-feature' => 'image-feature','landscape image-feature' => 'landscape image-feature'], null, ['class'=>'form-control','required'=>'required']) }}
			{{ errors_for('view_type',$errors) }}

		</div>
		<div class="form-group">
			{{ Form::label('published','Published:')}}
			{{ Form::select('published', ['1' => 'Yes', '0' => 'No'], null,['class'=>'form-control','required'=>'required']) }}
			{{ errors_for('published',$errors) }}

		</div>
		<div class="form-group">
			{{ Form::label('featured','Featured:')}}
			{{ Form::select('featured', ['0' => 'No', '1' => 'Yes'], null,['class'=>'form-control','required'=>'required']) }}
			{{ errors_for('featured',$errors) }}

		</div>
		
		<div class="form-group">
			{{ Form::submit('Update Category',['class'=>'btn btn-primary'])}}
			{{ link_to_route('admin.categories.index', 'Cancel', null, ['class'=>'btn btn-default'])}}

		</div>
	</div>
	<div class="col-xs-6 col-md-6">
	 	<div class="form-group">
	       
		    {{ Form::label('image','Main image:')}}

		        
	        <div class="main_image">
	            @if ($category->image)
	               <img src="{{ photos_path('categories') }}thumb_{{ $category->image }}" alt="{{ $category->image }}"></a>
	            @else
	                <img src="/img/no-image.png" alt="No Image">
	            @endif
	            
	        </div>
	               
	    </div>
	    <div class="form-group">
	    	 {{ Form::file('image') }}
	    	 {{ errors_for('image',$errors) }}
	    </div>
	</div>
	{{ Form::close() }}
</div>
@stop