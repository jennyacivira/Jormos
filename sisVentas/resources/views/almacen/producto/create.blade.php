@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Producto</h3>
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

			{!!Form::open(array('url'=>'almacen/producto','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    <div class="row">
        <div class="col-lg-6 col col-md col-xs-12">
            <div class="form-group">
                <label>Fabricante</label>
                <select name="idcategoria" class="form-control">
                @foreach ($categorias as $cat)
                <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
                @endforeach 
                </select>
            </div>
        </div>  
    	<div class="col-lg-6 col col-md col-xs-12">
    		<div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" requerid values="{{old('nombre')}}"class="form-control" placeholder="Nombre...">
            </div>
    	</div>	
    	
    	<div class="col-lg-6 col col-md col-xs-12">
    		<div class="form-group">
            	<label for="codigo">Codigo</label>
            	<input type="text" name="codigo" requerid values="{{old('codigo')}}"class="form-control" placeholder="Codigo...">
            </div>
    	</div>	
        <div class="col-lg-6 col col-md col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" requerid values="{{old('descripcion')}}"class="form-control" placeholder="Descripcion...">
            </div>
        </div>  
         <div class="col-lg-6 col col-md col-xs-12">
            <div class="form-group">
                <label for="partida_arancelaria">Partida Arancelaria</label>
                <input type="text" name="partida_arancelaria" requerid values="{{old('partida_arancelaria')}}"class="form-control" placeholder="Partida Arancelaria...">
            </div>
        </div>  
    		
    	 	
    </div>        
            
            
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            

@endsection