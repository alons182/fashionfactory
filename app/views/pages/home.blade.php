@extends('layouts.layout')

@section('content') 


<div class="carousel">
    <div class="ca-wrapper">
        
        @foreach ($categories as $category)
            
            <div class="ca-item category_item">
                <div class="category-image" >
                     @if ($category->slug == 'accesorios')
                        <a href="{{ URL::route('products', $category->slug) }}"> <img src="{{ photos_path('categories').$category->image }}" alt="{{ $category->name }}"></a>
                     @else
                        <a href="{{ URL::route('category', $category->slug) }}"> <img src="{{ photos_path('categories').$category->image }}" alt="{{ $category->name }}"></a>
                     @endif
                    <div class="category-background"></div>
                     
                     @if ($category->slug == 'accesorios')
                        {{ link_to_route('products','Ver', $category->slug , ['class' => 'category-readmore']) }}
                     @else
                        {{ link_to_route('category','Ver', $category->slug , ['class' => 'category-readmore']) }}
                     @endif
                    
                    
                    <div class="title-overlay"></div>
                    <h4 class="category-title">{{ $category->name }}</h4>
                    
                </div>
            </div>
           
        @endforeach
       
       
    </div>
   
</div>
@stop