@extends('layouts.layout')

@section('content') 


<div class="categories-content">

    <div class="portafolio cat">
       
		@foreach ($categories as $category)
			
			<div class="element {{ ($category->view_type == 'default') ? '' : $category->view_type }}  ">
	            <div class="inner-element" >
	                <div class="category-image">
	                    @if($category->image)
	                    	<a href="{{ URL::route('products', $category->slug) }}"> <img src="{{ photos_path('categories').$category->image }}" alt="{{$category->name}}"></a>
	                    @else
	                    	<a href="{{ URL::route('products', $category->slug) }}"> <img src="holder.js/481x631/text:No-image" alt="{{$category->name}}"></a>
	                    @endif
	                </div>
	                <div class="category-overlay"></div>
	                <h2 class="category-title">{{ link_to_route('products',$category->name, $category->slug) }}</h2>
	                <div class="category-view">
	                    {{ link_to_route('products','Ver', $category->slug , ['class' => 'category-viewmore']) }}
	                    
	                </div>
	            	                
	            </div>
	        </div>


		@endforeach

        
        
        

    </div>
    
   
   
</div>
   
</div>
@stop