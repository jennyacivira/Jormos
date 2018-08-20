@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Clientes <a href="articulo/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('almacen.articulo.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
				
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Fabricante</th>
					<th>Razon Social</th>
					<th>RUC</th>
					<th>Direccion</th>
					<th>Telefono</th>
					<th>Email</th>
					<th>Estado</th>
				</thead>
               @foreach ($articulos as $art)
				<tr>
					
					<td>{{ $art->codigo}}</td>
					<td>{{ $art->nombre}}</td>
					<td>{{ $art->categoria}}</td>
					<td>{{ $art->razon_social}}</td>
					<td>{{ $art->ruc}}</td>
					<td>{{ $art->direccion}}</td>
					<td>{{ $art->telefono}}</td>
					<td>{{ $art->email}}</td>
					<td>{{ $art->estado}}</td>
					<td>
						<a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.articulo.modal')
				@endforeach
			</table>
		</div>
		{{$articulos->render()}}
	</div>
</div>

@endsection