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