@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Fabricante</h3>
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
			{!!Form::open(array('url'=>'almacen/categoria','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
             <div class="row">
    			<div class="col-lg-6 col col-md col-xs-12">
		            <div class="form-group">
		            	<label for="nombre">Nombre</label>
		            	<input type="text" name="nombre" class="form-control" placeholder="Nombre...">
		            </div>
	       		</div>
	       		<div class="col-lg-6 col col-md col-xs-12">
		            <div class="form-group">
		            	<label for="codigo">Codigo</label>
		            	<input type="text" name="codigo" class="form-control" placeholder="Codigo...">
		            </div>
	       		</div>
	       		<div class="col-lg-6 col col-md col-xs-12">
		            <div class="form-group">
		            	<label for="descripcion">Descripción</label>
		            	<input type="text" name="descripcion" class="form-control" placeholder="Descripción...">
		            </div>
		         </div> 
			    <div class="col-lg-6 col col-md col-xs-12">
		            <div class="form-group">
		                    <label for="direccion">Direccion</label>
		                    <input type="text" name="direccion" requerid class="form-control" placeholder="Direccion...">
		            </div>
		        </div>    
	            <div class="col-lg-6 col col-md col-xs-12">
		    		<div class="form-group">
		            	<label for="telefono">Telefono</label>
		            	<input type="text" name="telefono" requerid class="form-control" placeholder="Telefono...">
		            </div>
		    	</div>
		    	<div class="col-lg-6 col col-md col-xs-12">
		    		<div class="form-group">
		            	<label for="email">Email</label>
		            	<input type="email" name="email" requerid class="form-control" placeholder="Email">
		            </div>
		    	</div>	
		    		
        </div>  
		   


		            <div class="form-group">
		            	<button class="btn btn-primary" type="submit">Guardar</button>
		            	<button class="btn btn-danger" type="reset">Cancelar</button>
		            </div>
			
			{!!Form::close()!!}		
            
	
@endsection