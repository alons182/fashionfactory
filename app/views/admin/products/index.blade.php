@extends('admin.layouts.layout')

@section('content') 
     
    
   @include('admin/products/partials/_search')
   
	
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
                            
                            @if ($product->published) 
                                <button type="submit"  class="btn btn-default btn-xs" form="form-pub-unpub" formaction="{{ URL::route("products.unpub", [$product->id]) }}"><i class="glyphicon glyphicon-ok"></i></button>
                            @else 
                                <button type="submit"  class="btn btn-default btn-xs "form="form-pub-unpub" formaction="{{ URL::route("products.pub", [$product->id]) }}" ><i class="glyphicon glyphicon-remove"></i></button>
                            @endif 
                             
                    </td>
                    <td>
                    
                       <button type="submit" class="btn btn-danger btn-sm" form="form-delete" formaction="{{ URL::route("admin.products.destroy", [$product->id]) }}">Delete</button>                      
                                                              
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

{{ Form::open(array('method' => 'post', 'id' => 'form-pub-unpub')) }}{{ Form::close() }}
{{ Form::open(['method' => 'delete', 'id' =>'form-delete','data-confirm' => 'Are you sure?']) }}{{ Form::close() }}

@stop