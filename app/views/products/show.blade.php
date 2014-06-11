@extends('layouts.layout')

@section('content') 


<div class="productdetails-view productdetails">

	<div class="main-image">
		@if($product->image)
			<div class="easyzoom easyzoom--adjacent">
			    <a href="{{ photos_path('products').$product->image }}">
			        <img src="{{ photos_path('products').$product->image }}" alt="{{ $product->name }}"  />
			    </a>
			</div>
			
			<!--<a href="{{ photos_path('products').$product->image }}" data-lightbox="image-1"> <img src="{{ photos_path('products').$product->image }}" alt="{{ $product->name }}"></a>-->
		@else 
			<img src="holder.js/481x631/text:No-image" alt="{{ $product->name }}">
		@endif
	</div>
	
	<div class="product-info">
		<div class="product-inner">
			<h1 class="product-name">{{ $product->name }} </h1>
			<div class="clear"></div>
			@if ( $product->promo_price > 0 )
				<div class="product-price">
					<span class="tachado">{{ money($product->price, '&cent') }}</span>
				</div>
				<div class="product-price-promo">
					<span>{{ money($product->promo_price, '&cent') }}</span>
					<span class="icon icon-bookmark"><span class="discount">{{ porcent($product->discount) }}</span></span>
				</div>
			@else
				<div class="product-price">
					<span>{{ money($product->price, '&cent') }}</span>
				</div>
			@endif
			
			<div class="product-description">
				 <h3>Descripción</h3>
				 <p>{{ $product->description }}</p>
			</div>
			@if ( $product->sizes )
				<div class="product-sizes">
					 <h3>Tallas Disponibles: </h3>
					 {{ Form::select('sizes', $product->sizes, null , ['class'=>'form-control']) }}
				</div>
			@endif
			@if ( $product->colors )
				<div class="product-colors">
					 <h3>Colores Disponibles:</h3>
					 <div class="colors">
					 	@foreach ($product->colors as $color)
							<div class="color" style="background-color: #{{ $color }};"></div>
						@endforeach
					 </div>
				</div>
			@endif
			
			@if (count($relateds)>0)
				<div class="other-products">Productos Relacionados</div>
				<div class="related-products">
					<div class="ca-wrapper">
					
					@foreach ($relateds as $related)
						<div  class="ca-item related-item">
							<a href="{{ URL::route('product', [$related->categories->last()->slug, $related->slug]) }}">
								@if ($related->image)
								<img src="{{ photos_path('products') }}thumb_{{ $related->image }}" data-src="{{ photos_path('products') }}{{ $related->image}}" alt="{{ $related->name }}">
								@else 
								<img src="holder.js/184x240/text:No-image" alt="{{ $related->name }}">
								@endif
								<span class="caption">
									<span class="related-name">{{ $related->name }}</span>
									<span class="related-price">{{ money($related->price, '&cent') }}</span>
								</span>
								
							</a>
							
						</div>
					@endforeach
					
					</div>
					<div class="clear"></div>

				</div>
			@endif
			
			@if (count($photos)>0)
				<div class="other-image">Más imagenes</div>
				<div class="additional-images">
					
					<div class="floatleft">
						<img src="{{ photos_path('products') }}{{ $product->image }}" data-src="{{ photos_path('products').$product->image }}" alt="{{ $product->name }}" />
					</div>
					@foreach ($photos as $photo)
						<div class="floatleft">
							<img src="{{ photos_path('products') }}{{ $photo->product_id }}/{{ $photo->url }}" data-src="{{ photos_path('products') }}{{ $photo->product_id }}/{{ $photo->url}}" alt="{{ $product->name }}">
						</div>
					@endforeach
					
					
					<div class="clear"></div>

				</div>
			@endif
		</div>
	</div>
		 
</div>
	


@stop