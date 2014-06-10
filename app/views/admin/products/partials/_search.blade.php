 <div class="well well-large actions">
           
            <div class="filtros">
               
               
                {{ Form::open(['url' => 'admin/products','method' => 'get']) }}
                   <div class="form-group">
                        <div class="controls">
                            {{ Form::label('q', 'Buscar') }}
                            {{ Form::text('q',$search, ['class'=>'form-control'] ) }}
                        </div>
                   
                        <div class="controls">
                            {{ Form::label('cat', 'Categorias') }}
                            {{ Form::select('cat', ['' => '-- Seleccionar --'] + $options, $categorySelected, ['class'=>'form-control'] ) }}
                        </div>
                         <div class="controls">
                            {{ Form::label('published', 'Estado') }}
                            {{ Form::select('published', ['' => '-- Seleccionar --','0' => 'Unpublicado','1' => 'Publicado'], $selectedStatus, ['class'=>'form-control'] ) }}
                        </div>
                        
                 </div>  
                {{ Form::close() }}

            </div>
</div> 