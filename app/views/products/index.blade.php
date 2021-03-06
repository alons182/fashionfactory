@extends('layouts.layout')
@section('meta-title')
Fashion Factory | Products
@stop
@section('content') 


<div class="categories-content">

    <div class="portafolio prod">
       
		@foreach ($products as $product)
	        <div class="element ">
	            <div class="inner-element" >
	                <div class="product">
	                    <div class="product-image">
	                    	@if($product->image)
	                        	<a href="{{ URL::route('product', [$product->categories->last()->slug, $product->slug]) }}"> <img src="{{ photos_path('products').$product->image }}" alt="{{$product->name}}"></a>
	                        @else 
	                        	<a href="{{ URL::route('product', [$product->categories->last()->slug, $product->slug]) }}"> <img src="holder.js/481x631/text:No-image" alt="{{$product->name}}"></a>
	                        @endif
	                    </div>
	                    <h2 class="product-title-display">{{ link_to_route('product', $product->name , [$product->categories->last()->slug, $product->slug]) }}</h2>
	                    <div class="product-info">
	                        <h2 class="product-title">
	                        	{{ link_to_route('product', $product->name , [$product->categories->last()->slug, $product->slug]) }}
	                            
	                        </h2>
	                        <p class="product-s-description">{{ str_limit($product->description, 50) }}</p>
	                        <div class="product-price">
	                            <span>{{ money($product->price, '&cent') }}</span>
	                        </div>
	                    </div>
	                    <div class="product-view">
	                        <a href="{{ URL::route('product', [$product->categories->last()->slug, $product->slug]) }}" class="product-details" ><i class="icon-search"></i></a>
	                        
	                    </div>
	                    <div class="clear"></div>
	                    
	                </div>
	           
	            </div>
	        </div>
	    @endforeach

    </div>
    @if(isset($search))
   		<div class="pagination-container">{{$products->appends(['q' => $search])->links()}}</div>
    @else 
		<div class="pagination-container">{{$products->links()}}</div>
	@endif
</div>

@stop