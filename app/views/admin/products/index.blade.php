@extends('admin.layouts.layout')

@section('content') 
     
    
    <div class="well well-large actions">
           
            <div class="filtros">
               
               
                {{ Form::open(['url' => 'admin/products','method' => 'get']) }}
                   <div class="form-group">
                        <div class="controls">
                            {{ Form::label('q', 'Search') }}
                            {{ Form::text('q',$search, ['class'=>'form-control'] ) }}
                        </div>
                   
                        <div class="controls">
                            {{ Form::label('cat', 'Categories') }}
                            {{ Form::select('cat', ['' => '-- Select --'] + $options, $categorySelected, ['class'=>'form-control'] ) }}
                        </div>
                         <div class="controls">
                            {{ Form::label('published', 'State') }}
                            {{ Form::select('published', ['' => '-- Select --','0' => 'Unpublished','1' => 'Published'], $selectedStatus, ['class'=>'form-control'] ) }}
                        </div>
                        
                 </div>  
                {{ Form::close() }}

            </div>
    </div> 
   
	
	<div class="table-responsive">
        {{ link_to_route('admin.products.create','New product',null,['class'=>'btn btn-success']) }}
        <table class="table table-striped  ">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Categories</th>
                <th>When</th>
                <th>Published</th>
                <th><i class="glyphicon glyphicon-cog"></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ link_to_route('admin.products.edit', $product->name, $product->id) }}</td>
                    <td>{{ str_limit($product->description, 20) }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                         @foreach ($product->categories as $category)
                            {{ $category->name }} - 
                        @endforeach 
                    </td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        {{ Form::open(['route' => ['update_product_state', $product->id],'method' => 'post']) }}
                            
                            @if ($product->published == 1) 
                                <button type="submit"  class="btn btn-default btn-xs" ><i class="glyphicon glyphicon-ok"></i></button>
                            @else 
                                <button type="submit"  class="btn btn-default btn-xs " ><i class="glyphicon glyphicon-remove"></i></button>
                            @endif 
                             
                             {{ Form::hidden('published', $product->published) }}
                           
                        {{ Form::close() }}
                    </td>
                    <td>
                                             
                       
                    {{ Form::open(['route' => ['admin.products.destroy', $product->id ], 'method' => 'delete', 'data-confirm' => 'Are you sure?']) }}
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    {{ Form::close() }}
                         

                        
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
       <tfoot>
           
            @if ($products) 
                <td  colspan="10" class="pagination-container">{{$products->appends(['q' => $search,'cat'=>$categorySelected,'published'=>$selectedStatus])->links()}}</td>
                 @endif 
            
             
        </tfoot>
    </table>

     
    </div>  


@stop