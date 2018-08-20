@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Fabricante: {{ $categoria->nombre}}</h3>
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
			{!!Form::model($categoria,['method'=>'PATCH','route'=>['almacen.categoria.update',$categoria->idcategoria]])!!}
            {{Form::token()}}
            <div class="row">
            <div class="col-lg-6 col col-md col-xs-12">
	            <div class="form-group">
	            	<label for="nombre">Nombre</label>
	            	<input type="text" name="nombre" class="form-control" value="{{$categoria->nombre}}" placeholder="Nombre...">
	            </div>
        	</div>
        	<div class="col-lg-6 col col-md col-xs-12">
	            <div class="form-group">
	            	<label for="codigo">Codigo</label>
	            	<input type="text" name="codigo" class="form-control" value="{{$categoria->codigo}}" placeholder="Codigo...">
	            </div>
        	</div>
            <div class="col-lg-6 col col-md col-xs-12">
	            <div class="form-group">
	            	<label for="descripcion">Descripción</label>
	            	<input type="text" name="descripcion" class="form-control" value="{{$categoria->descripcion}}" placeholder="Descripción...">
	            </div>
        	</div>

			</div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            

@endsection