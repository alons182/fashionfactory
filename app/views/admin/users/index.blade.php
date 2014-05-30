@extends('admin.layouts.layout')

@section('content') 
     
     <div class="well well-large actions">
           
            <div class="filtros">
               
               
                {{ Form::open(['url' => 'admin/users','method' => 'get']) }}
                   <div class="form-group">
                        <div class="controls">
                            {{ Form::label('q', 'Search') }}
                            {{ Form::text('q',$search, ['class'=>'form-control'] ) }}
                        </div>
                        
                 </div>  
                {{ Form::close() }}

            </div>
    </div> 

	<div class="table-responsive">
        {{ link_to_route('user_register','New User',null,['class'=>'btn btn-success']) }}
        <table class="table table-striped  ">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Type</th>
                <th>When</th>
                <th><i class="icon-cog"></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ link_to_route('admin.users.edit', $user->username, $user->id) }}
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->user_type }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                                             
                       
                    {{ Form::open(['route' => ['admin.users.destroy', $user->id ], 'method' => 'delete', 'data-confirm' => 'Are you sure?']) }}
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    {{ Form::close() }}
                         

                        
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
       <tfoot>
           
             @if ($users) 
                <td  colspan="10">{{$users->links()}}</td>
                 @endif 
             
        </tfoot>
    </table>
    </div>  


@stop