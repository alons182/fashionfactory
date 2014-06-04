<div class="col-xs-12 col-sm-6">
		@if(isset($product))
			{{ Form::hidden('product_id',  $product->id) }}
		@endif		
		<div class="form-group">
			{{ Form::label('name','Name:')}}
			{{ Form::text('name',null,['class'=>'form-control','required'=>'required'])}}
			{{ errors_for('name',$errors) }}
			

		</div>
		<div class="form-group">
			{{ Form::label('categories','Categories:')}}
			{{ Form::select('categories[]', $categories, isset($selected) ? $selected : null , ['multiple' => 'multiple','class'=>'form-control','required'=>'required']) }}
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
			{{ Form::submit(isset($buttonText) ? $buttonText : 'Create Product',['class'=>'btn btn-primary'])}}
			{{ link_to_route('admin.products.index', 'Cancel', null, ['class'=>'btn btn-default'])}}

		</div>
		
		
</div>
<div class="col-xs-6 col-md-6">
		<div class="form-group">
			{{ Form::label('image','Main image:')}}
			@if (isset($product))
				<div class="main_image">
		            @if ($product->image)
		               <img src="{{ photos_path('products') }}thumb_{{ $product->image }}" alt="{{ $product->image }}"></a>
		            @else
		                <img src="/img/no-image.png" alt="No Image">
		            @endif
		            
		        </div>
		    @endif
			{{ Form::file('image') }}
			{{ errors_for('image',$errors) }}
		</div>


		<div class="form-group">
		 	
		 	<legend>Gallery</legend>

		 	@if(isset($product))
		 		
		        <div id="container-gallery">
		            
		            <a class="UploadButton btn btn-info" id="UploadButton">Upload Image</a>
		            <div id="InfoBox"></div>
		            <ul id="gallery">
		                   
			            @foreach ($product->photos as $photo)
				            <li>
				            	<span class="delete" data-imagen="{{ $photo->id }}"><i class="glyphicon glyphicon-remove"></i></span>
				            	<a href="{{ photos_path('products') }}{{ $photo->product_id }}/{{ $photo->url }}" data-lightbox="gallery"><img src="{{ photos_path('products') }}{{ $photo->product_id }}/{{ $photo->url_thumb }}" alt="img" /></a>
				            </li>
		            	@endforeach
		                
		            </ul>
		            <script id="photoTemplate" type="text/x-handlebars-template">
	         			   
	         			   <li>
				            	<span class="delete" data-imagen="@{{ id }}"><i class="glyphicon glyphicon-remove"></i></span>
				            	<a href="/images_store/products/@{{ product_id }}/@{{ url }}" data-lightbox="gallery"><img src="/images_store/products/@{{ product_id }}/@{{ url_thumb }}" alt="img" /></a>
				            </li>
				         
				          
				    </script>
		            
		        </div>
		    @else 
		        <div id="inputs_photos">
	                  
		        	<input class="inputbox btn btn-info" type="button" name="new_photo"  value="Nueva Foto"  id="add_input_photo"/><i class="glyphicon glyphicon-plus-sign"></i>
		        
		        </div>
		        
		    @endif
	    </div>

 </div>
	 