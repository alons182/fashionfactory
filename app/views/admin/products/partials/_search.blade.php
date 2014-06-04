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