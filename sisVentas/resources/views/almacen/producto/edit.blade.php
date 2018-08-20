@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Producto: {{ $Producto->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
			{!!Form::model($producto,['method'=>'PATCH','route'=>['almacen.producto.update',$producto->idproducto]])!!}
            {{Form::token()}}
             <div class="row">
            	<div class="col-lg-6 col col-md col-xs-12">
            		<div class="form-group">
                    	<label for="nombre">Nombre</label>
                    	<input type="text" name="nombre" requerid value="{{$producto->nombre}}"class="form-control" >
                    </div>
    	       </div>	
            	<div class="col-lg-6 col col-md col-xs-12">
            		<div class="form-group">
            			<label>Fabricante</label>
            			<select name="idarticulo" class="form-control">
            			@foreach ($categorias as $cat)
            				@if ($cat->idcategoria==$producto->idcategoria)
            				<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
                            @else
                            <option value="{{$cat->idcategoria}}" >{{$cat->nombre}}</option>
                            @endif
            			@endforeach 
            			</select>
            		</div>
            	</div>	
            	<div class="col-lg-6 col col-md col-xs-12">
            		<div class="form-group">
                    	<label for="codigo">Codigo</label>
                    	<input type="text" name="codigo" requerid value="{{$producto->codigo}}"class="form-control">
                    </div>
            	</div>	
            	
                <div class="col-lg-6 col col-md col-xs-12">
                    <div class="form-group"></div>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                </div>  

            </div> 



			{!!Form::close()!!}		
            
		
@endsection