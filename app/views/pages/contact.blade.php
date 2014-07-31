@extends('layouts.layout')
@section('meta-title')
Fashion Factory | Contacto
@stop
@section('content') 


	<div class="page contact align-center">
		<div class="section-bg" data-bg="/img/about.jpg">
		</div>
		@include('layouts/partials/_flash_message')
		<div class="inner-about">
			
			<h1>Contáctenos</h1>
			<p class="intro">"Llamános o escribínos para solucionar cualquier duda o consulta que tengas, en Fashion Factory estamos para servirle !!"</p>
			<address>
				<span>info@fashionfactorycr.com</span><br />
				<span>2666 1254</span>
			</address>	
			<div class="bg_white">
				{{ Form::open(['route'=>'contact.store','class'=>'form-contact']) }}
				
					<div class="form-group">
						<div class="label-container">
							{{ Form::label('name','Nombre:')}}
						</div>
						<div class="input-container">
						{{ Form::text('name',null,['class'=>'form-control','required'=>'required'])}}
						{{ errors_for('name',$errors) }}
						</div>

					</div>
					<div class="form-group">
						<div class="label-container">
							{{ Form::label('email','Email:')}}
						</div>
						<div class="input-container">
						{{ Form::email('email',null,['class'=>'form-control','required'=>'required'])}}
						{{ errors_for('email',$errors) }}
						</div>
					</div>
					<div class="form-group">
						
						{{ Form::textarea('comment',null,['class'=>'form-control','required'=>'required']) }}
						{{ errors_for('comment',$errors) }}
					</div>
					<div class="form-group">
						{{ Form::submit('Enviar',['class'=>'btn btn-primary'])}}
						
						

					</div>
				
				{{ Form::close() }}
			</div>


		</div>
		

	</div>


@stop