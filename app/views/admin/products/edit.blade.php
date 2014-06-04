@extends('admin.layouts.layout')

@section('content')
<div class="starter-template">
	<h1>Product Editing</h1>
	
	{{ Form::model($product, ['method' => 'put', 'route' => ['admin.products.update', $product->id],'files'=> true ]) }}
		
		@include('admin/products/partials/_form', ['buttonText' => 'Update Product'])
	 
	{{ Form::close() }}
</div>
@stop