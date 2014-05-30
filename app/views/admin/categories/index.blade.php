@extends('admin.layouts.layout')

@section('content') 
     
     
    <div class="well well-large actions">
           
            <div class="filtros">
               
               
                {{ Form::open(['url' => 'admin/categories','method' => 'get']) }}
                   <div class="form-group">
                        <div class="controls">
                            {{ Form::label('q', 'Search') }}
                            {{ Form::text('q',$search, ['class'=>'form-control'] ) }}
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
        {{ link_to_route('admin.categories.create','New Category',null,['class'=>'btn btn-success']) }}
        <table class="table table-striped  ">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>When</th>
                <th>Pub | Feat</th>
                <th><i class="glyphicon glyphicon-cog"></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        @if ($category->depth > 1 )
                            {{ get_depth($category->depth)}} {{  link_to_route('admin.categories.edit', $category->name, $category->id) }}
                        @else 
                            {{ link_to_route('admin.categories.edit', $category->name, $category->id) }}
                        @endif
                    </td>
                    <td>{{ str_limit($category->description, 20) }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        {{ Form::open(['route' => ['update_category_state', $category->id],'method' => 'post']) }}
                            
                            @if ($category->published == 1) 
                                <button type="submit"  class="btn btn-default btn-xs" ><i class="glyphicon glyphicon-ok"></i></button>
                            @else 
                                <button type="submit"  class="btn btn-default btn-xs " ><i class="glyphicon glyphicon-remove"></i></button>
                            @endif 
                             
                             {{ Form::hidden('published', $category->published) }}
                           
                        {{ Form::close() }}

                         {{ Form::open(['route' => ['update_category_state', $category->id],'method' => 'post']) }}
                            
                            @if ($category->featured == 1) 
                                <button type="submit"  class="btn btn-default btn-xs" ><i class="glyphicon glyphicon-star"></i></button>
                            @else 
                                <button type="submit"  class="btn btn-default btn-xs " ><i class="glyphicon glyphicon-star-empty"></i></button>
                            @endif 
                             
                             {{ Form::hidden('featured', $category->featured) }}
                           
                        {{ Form::close() }}
                    </td>
                    
                    <td>
                                             
                       
                    {{ Form::open(['route' => ['admin.categories.destroy', $category->id ], 'method' => 'delete', 'data-confirm' => 'Are you sure?']) }}
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    {{ Form::close() }}
                         

                        
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
       <tfoot>
         
            @if ($categories) 
                <td  colspan="10" class="pagination-container">{{$categories->appends(['q' => $search,'published'=>$selectedStatus])->links()}}</td>
            @endif 
            
             
        </tfoot>
    </table>

     
    </div>  


@stop