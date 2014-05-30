@extends('layouts.layout')

@section('content') 


<div class="productdetails-view productdetails">

	<div class="main-image">
		@if($product->image)
			<a href="{{ photos_path('products').$product->image }}" data-lightbox="image-1"> <img src="{{ photos_path('products').$product->image }}" alt="{{ $product->name }}"></a>
		@else 
			<img src="/img/no-image.jpg" alt="{{ $product->name }}">
		@endif
	</div>
	
	<div class="product-info">
		<div class="product-inner">
			<h1 class="product-name">{{ $product->name }} </h1>
			<div class="product-price">
				<span>&cent; {{ $product->price }}</span>
			</div>
			
			<div class="product-description">
				 <h2>Description</h2>
				 <p>{{ $product->description }}</p>
			</div>
			
			@if (count($photos)>0)
				<div class="other-image">Más imagenes</div>
				<div class="additional-images">
					
					<div class="floatleft">
						<img src="{{ photos_path('products') }}thumb_{{ $product->image }}" data-src="{{ photos_path('products').$product->image }}" alt="{{ $product->name }}">
					</div>
					@foreach ($photos as $photo)
						<div class="floatleft">
							<img src="{{ photos_path('products') }}{{ $photo->product_id }}/{{ $photo->url_thumb }}" data-src="{{ photos_path('products') }}{{ $photo->product_id }}/{{ $photo->url}}" alt="{{ $product->name }}">
						</div>
					@endforeach
					
					
					<div class="clear"></div>

				</div>
			@endif
		</div>
	</div>
		 
</div>
	


@stop