@extends('admin.layouts.layout')

@section('content')
<div class="starter-template">
	<h1>Category Editing</h1>
	
	{{ Form::model($category, ['method' => 'put', 'route' => ['admin.categories.update', $category->id],'files'=> true ]) }}
		 @include('admin/categories/partials/_form',['buttonText' => 'Update Category'])
	{{ Form::close() }}
</div>
@stop