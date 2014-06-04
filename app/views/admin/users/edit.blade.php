@extends('admin.layouts.layout')

@section('content')
<div class="starter-template">
	<h1>Update User</h1>
	{{ Form::model($user, ['method' => 'put', 'route' => ['admin.users.update', $user->id] ]) }}
		 @include('admin/users/partials/_form',['buttonText' => 'Update User'])
	{{ Form::close() }}
</div>
@stop